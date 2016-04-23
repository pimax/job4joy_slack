<?php

namespace pimax\slackbot;

class TranslationsCommand extends FeedCommand
{
    protected function configure()
    {
        $this->setName('translations');
    }

    protected function execute($message, $context)
    {
        global $config;

        $this->getFeed($config['feeds']['translations']['Feed'], $config['token']);
    }
}