<?php

$config = []; // config
if (file_exists(__DIR__.'/../config.php')) {
    $config = include __DIR__.'/../config.php';
}

$response = [
    'client_id' => $config['client_id'],
    'client_secret' => $config['client_secret'],
    'code' => $_REQUEST['code'],
    'redirect_uri' => $config['redirect_uri']
];

$url = 'https://slack.com/api/oauth.access';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($response));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$body = curl_exec($ch);
if ($body === false) {
    throw new \Exception('Error when requesting '.$url.' '.curl_error($ch));
}
curl_close($ch);
$response = json_decode($body, true);
if (is_null($response)) {
    throw new \Exception('Error when decoding body ('.$body.').');
}
if (isset($response['error'])) {
    throw new \Exception($response['error']);
}

echo '<pre>', print_r($response), '</pre>';