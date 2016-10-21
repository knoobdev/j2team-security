<?php
use J2TeaM\Library\DataWrite;
use J2TeaM\Model\Wordlist;

$app->get('/', function ($request, $response, $args) {
    $wordlist = new Wordlist;
    $wordlist = $wordlist->get_all();
    return view('home',['wordlists' => $wordlist]);
})->setName('home');


$app->post('/save', function ($request, $response, $args) use($app) {
    $input = $request->getParams();
    if (!isset($input)) return FALSE;
    $input = isset($input['J2TeaM']) ? $input['J2TeaM'] : NULL;
    if (NULL==$input) return FALSE;
    $wordlist = new Wordlist;
    foreach ($input as $name => $value) {
        $domain[$name] = explode("\n",$value);
        $domain[$name] = serialize($domain[$name]);
        $wordlist->update($name, $domain[$name]);
    }
    return $response->withRedirect($this->router->pathFor('home'),302);
});
