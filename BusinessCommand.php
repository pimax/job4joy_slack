<?php

namespace pimax\slackbot;

class BusinessCommand extends FeedCommand
{
    protected function configure()
    {
        $this->setName('business');
    }

    protected function execute($message, $context)
    {
        global $config;

        $this->getFeed($config['feeds']['business']['Feed'], $config['token']);
    }
}