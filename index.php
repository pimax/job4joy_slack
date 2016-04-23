<?php

require 'vendor/autoload.php';
require 'bootstrap.php';

use PhpSlackBot\Bot;
use pimax\slackbot\StartCommand;
use pimax\slackbot\AllCommand;

$config = []; // config
if (file_exists(__DIR__.'/config.php')) {
    $config = include __DIR__.'/config.php';
}


$bot = new Bot();
$bot->setToken($config['token']); // Get your token here https://my.slack.com/services/new/bot
$bot->loadCommand(new StartCommand());
$bot->loadCommand(new AllCommand());
$bot->run();