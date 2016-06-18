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
file_put_contents(__DIR__. '/../installed/'.$response['team_id'].'.php', "<?php\nreturn " . var_export($response, true) . ";\n");
header("Content-Type: text/html; charset=utf-8");
echo '<h1>Job4Joy App successful installed!</h1><br/>';
echo "You can find @job4joy_bot in your Slack team.<br />
Just type \"start\" for start using our bot.

<h2>Commands</h2>
Our Bot understand this commands:<br />

    <strong>start</strong> - Help message<br />

    <strong>all</strong> - All Jobs<br />

    <strong>webdev</strong> - Web Development<br />

    <strong>software</strong> - Software Development & IT<br />

    <strong>design</strong> - Design & Multimedia<br />

    <strong>mobile</strong> - Mobile Application<br />

    <strong>server</strong> - Host & Server Management<br />

    <strong>writing</strong> - Writing<br />

    <strong>customer</strong> - Customer Service<br />

    <strong>marketing</strong> - Marketing<br />

    <strong>business</strong> - Business Services<br />

    <strong>translations</strong> - Translation & Languages

<h2>Support</h2>
If you have a problem with install or using our bot, write to us: admin@job4joy.com";