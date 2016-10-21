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
    $domain = [];
    foreach ($input as $name => $value) {
        $domain[$name] = explode("\n",$value);
        $d = [];
        foreach($domain[$name] as $k => $val) {
            $d[] = trim($val);
            unset($domain[$name][$k]);
        }
        $d[$name] = serialize($d);
        $wordlist->update($name, $d[$name]);
        unset($d[$name],$input[$name]);
    }
    return $response->withRedirect($this->router->pathFor('home'),302);
});

$app->get('/export', function ($request, $response, $args) {
    $input = $request->getParams();
    if (!isset($input)) return FALSE;
    $input = isset($input['download']) ? (("true"===$input['download']) ? TRUE : FALSE) : FALSE;
    if (!$input) return FALSE;
    $wordlist = new Wordlist;
    $wordlists = $wordlist->get_all();
    $data = [];
    /**
     * Type map
     * 0: phishing
     * 1: malware
     * 2: scam
     * 3: other
     */
    //print_r($wordlists);die;
    foreach ($wordlists as $key => $wordlist) {
        $v = get_value_to_array($wordlist['VALUE'],get_type_value($wordlist['NAME']));
        foreach ($v as $k => $vv) {
            array_push($data,$vv);
            unset($v[$k]);
        }
        unset($wordlist[$key]);
    }
    header("Cache-Control: public");
    header('Content-Type: application/json');
    header("Content-Transfer-Encoding: Binary");
    header("Content-Disposition: attachment; filename=db.json");
    echo response_json($data);
    exit;
});
