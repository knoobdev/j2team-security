<?php
use J2TeaM\Library\DataWrite;
use J2TeaM\Model\Wordlist;

$app->get('/', function ($request, $response, $args) {
    $wordlist = new Wordlist;
    $a = $wordlist->get_all();
    return view('home');
})->setName('home');

$app->get('/api/{name}', function ($request, $response, $args) use ($app) {
    $name = isset($args['name']) ? $args['name'] : NULL;
    if (NULL===$name) return redirect('home');
    $listType = ['autolike','malware','phishing','scam','other'];
    if (!in_array($name,$listType)) return response_json(['status' => false]);
    $wordlist = new Wordlist;
    return view('home');
});

$app->post('/save', function ($request, $response, $args) {

});
