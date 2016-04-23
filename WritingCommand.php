<?php

namespace pimax\slackbot;

class WritingCommand extends FeedCommand
{
    protected function configure()
    {
        $this->setName('writing');
    }

    protected function execute($message, $context)
    {
        global $config;

        $this->getFeed($config['feeds']['writing']['Feed'], $config['token']);
    }
}