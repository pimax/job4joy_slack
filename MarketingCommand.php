<?php

namespace pimax\slackbot;

class MarketingCommand extends FeedCommand
{
    protected function configure()
    {
        $this->setName('marketing');
    }

    protected function execute($message, $context)
    {
        global $config;

        $this->getFeed($config['feeds']['marketing']['Feed'], $config['token']);
    }
}