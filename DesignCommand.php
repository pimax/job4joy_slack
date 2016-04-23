<?php

namespace pimax\slackbot;

class DesignCommand extends FeedCommand
{
    protected function configure()
    {
        $this->setName('design');
    }

    protected function execute($message, $context)
    {
        global $config;

        $this->getFeed($config['feeds']['design']['Feed'], $config['token']);
    }
}