<?php
use Slim\Http\Response;
if (!function_exists('view')) {
    function view($filename, array $args = []) {
        global $container;
        return $container->view->render(new Response(),"/". $filename . EXT, $args);
    }
}

if (!function_exists('storage_path')) {
    function storage_path($dir) {
        return STORAGEPATH . $dir . DIRECTORY_SEPARATOR;
    }
}

if (!function_exists('sqlite3_file')) {
    function sqlite3_file($file) {
        return storage_path('data') . $file;
    }
}

if (!function_exists('response_json')) {
    function response_json(array $params = []) {
        header('Content-Type: application/json');
        return json_encode($params);
    }
}

if (!function_exists('redirect')) {
    function redirect($name) {
        global $app;
        $response = new Response();
        return $response->withRedirect($app->getContainer()->get('router')->pathFor($name));
    }
}

if (!function_exists('get_value_to_array')) {
    function get_value_to_array(array $args = [], $type) {
        $data = [];
        foreach($args as $key => $domain) {
            array_push($data,[
                'url' => str_replace("\r","",$domain),
                'type' => $type
            ]);
            unset($args[$key]);
        }
        return $data;
    }
}

if (!function_exists('get_type_name')) {
    function get_type_value($name) {
        switch ($name) {
            case 'phishing': return 0;
            case 'malware': return 1;
            case 'scam': return 2;
            case 'other': return 3;
        }
    }
}
