<?php

require 'vendor/autoload.php';
require 'bootstrap.php';

use PhpSlackBot\Bot;
use pimax\slackbot\StartCommand;
use pimax\slackbot\AllCommand;
use pimax\slackbot\WebdevCommand;
use pimax\slackbot\BusinessCommand;
use pimax\slackbot\CustomerCommand;
use pimax\slackbot\DesignCommand;
use pimax\slackbot\MarketingCommand;
use pimax\slackbot\MobileCommand;
use pimax\slackbot\ServerCommand;
use pimax\slackbot\SoftwareCommand;
use pimax\slackbot\TranslationsCommand;
use pimax\slackbot\WritingCommand;

$config = []; // config
if (file_exists(__DIR__.'/config.php')) {
    $config = include __DIR__.'/config.php';
}


$bot = new Bot();
$bot->setToken($config['token']); // Get your token here https://my.slack.com/services/new/bot
$bot->loadCommand(new StartCommand());
$bot->loadCommand(new AllCommand());
$bot->loadCommand(new WebdevCommand());
$bot->loadCommand(new BusinessCommand());
$bot->loadCommand(new CustomerCommand());
$bot->loadCommand(new DesignCommand());
$bot->loadCommand(new MarketingCommand());
$bot->loadCommand(new MobileCommand());
$bot->loadCommand(new ServerCommand());
$bot->loadCommand(new SoftwareCommand());
$bot->loadCommand(new TranslationsCommand());
$bot->loadCommand(new WritingCommand());
$bot->run();