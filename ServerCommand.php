<?php

namespace pimax\slackbot;

class ServerCommand extends FeedCommand
{
    protected function configure()
    {
        $this->setName('server');
    }

    protected function execute($message, $context)
    {
        global $config;

        $this->getFeed($config['feeds']['server']['Feed'], $config['token']);
    }
}