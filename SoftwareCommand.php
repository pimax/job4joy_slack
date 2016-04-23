<?php

namespace pimax\slackbot;

class SoftwareCommand extends FeedCommand
{
    protected function configure()
    {
        $this->setName('software');
    }

    protected function execute($message, $context)
    {
        global $config;

        $this->getFeed($config['feeds']['software']['Feed'], $config['token']);
    }
}