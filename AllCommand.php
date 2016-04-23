<?php

namespace pimax\slackbot;

class AllCommand extends FeedCommand
{
    protected function configure()
    {
        $this->setName('all');
    }

    protected function execute($message, $context)
    {
        global $config;

        $this->getFeed($config['feeds']['all']['Feed'], $config['token']);
    }
}