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

$app = []; // app
$config = []; // config
if (file_exists(__DIR__.'/config.php')) {
    $config = include __DIR__.'/config.php';
}

if (!empty($argv[1]) && file_exists('installed/'.$argv[1].'.php'))
{
    $app = include 'installed/'.$argv[1].'.php';
    $config['token'] = $app['bot']['bot_access_token'];
}
else
{
    echo "Instance #".$argv[1]. " not a found!";
    exit;
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

/**
 * Log
 *
 * @param mixed $data Data
 * @param string $title Title
 * @return bool
 */
function writeToLog($data, $title = '')
{
    $log = "\n------------------------\n";
    $log .= date("Y.m.d G:i:s") . "\n";
    $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
    $log .= print_r($data, 1);
    $log .= "\n------------------------\n";
    file_put_contents(__DIR__ . '/imbot.log', $log, FILE_APPEND);
    return true;
}