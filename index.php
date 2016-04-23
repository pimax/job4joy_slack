<?php

require 'vendor/autoload.php';

use PhpSlackBot\Bot;


$config = []; // config
if (file_exists(__DIR__.'/config.php')) {
    $config = include __DIR__.'/config.php';
}

class MyCommand extends \PhpSlackBot\Command\BaseCommand
{
    protected function configure()
    {
        $this->setName('mycommand');
    }

    protected function execute($message, $context)
    {
        $res = $this->postMessage($this->getCurrentChannel(), null, 'Hello! I can help you with IT projects.', [
            /*[
                'fallback' => 'all',
                'color' => '#36a64f',
                //'pretext' => 'Hello! I can help you with IT projects.',
                'title' => 'All Jobs!'
            ]*/

            [
                'text' => 'Test attachments'
            ]
        ]);

        echo '<pre>', print_r($res, true), '</pre>';
    }


    protected function postMessage($channel, $username, $message, $attachments = [])
    {
        global $config;

        $response = array(
            'token' => $config['token'],
            'as_user' => true,
            'id' => time(),
            'type' => 'message',
            'channel' => $channel,
            'text' => (!is_null($username) ? '<@'.$username.'> ' : '').$message
        );

        if (!empty($attachments)) {
            $response['attachments'] = $attachments;
        }

        $url = 'https://slack.com/api/chat.postMessage';
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


        return $response;
    }

}

$bot = new Bot();
$bot->setToken($config['token']); // Get your token here https://my.slack.com/services/new/bot
$bot->loadCommand(new MyCommand());
$bot->run();