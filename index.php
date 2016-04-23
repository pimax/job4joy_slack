<?php

require 'vendor/autoload.php';

use PhpSlackBot\Bot;

class MyCommand extends \PhpSlackBot\Command\BaseCommand
{

    protected function configure() {
        $this->setName('mycommand');
    }

    protected function execute($message, $context) {
        $this->send($this->getCurrentChannel(), null, 'Hello !', [
            [
                "pretext" =>"pre-hello",
                "text" => "text-world"
            ]
        ]);
    }


    protected function send($channel, $username, $message, $attachments = [])
    {
        $response = array(
            'id' => time(),
            'type' => 'message',
            'channel' => $channel,
            'text' => (!is_null($username) ? '<@'.$username.'> ' : '').$message
        );

        if (!empty($attachments)) {
            $response['attachments'] = $attachments;
        }

        $this->getClient()->send(json_encode($response));
    }

}

$config = []; // config
if (file_exists(__DIR__.'/config.php')) {
    $config = include __DIR__.'/config.php';
}

$bot = new Bot();
$bot->setToken($config['token']); // Get your token here https://my.slack.com/services/new/bot
$bot->loadCommand(new MyCommand());
$bot->run();