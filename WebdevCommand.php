<?php

namespace pimax\slackbot;

class WebdevCommand extends FeedCommand
{
    protected function configure()
    {
        $this->setName('webdev');
    }

    protected function execute($message, $context)
    {
        global $config;

        $this->getFeed($config['feeds']['webdev']['Feed'], $config['token']);
    }
}