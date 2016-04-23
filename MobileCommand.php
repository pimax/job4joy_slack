<?php

namespace pimax\slackbot;

class MobileCommand extends FeedCommand
{
    protected function configure()
    {
        $this->setName('mobile');
    }

    protected function execute($message, $context)
    {
        global $config;

        $this->getFeed($config['feeds']['mobile']['Feed'], $config['token']);
    }
}