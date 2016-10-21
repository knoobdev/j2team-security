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
