<?php

namespace pimax\slackbot;

class CustomerCommand extends FeedCommand
{
    protected function configure()
    {
        $this->setName('customer');
    }

    protected function execute($message, $context)
    {
        global $config;

        $this->getFeed($config['feeds']['customer']['Feed'], $config['token']);
    }
}