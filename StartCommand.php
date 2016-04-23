<?php

namespace pimax\slackbot;

class StartCommand extends AdvancedCommand
{
    protected function configure()
    {
        $this->setName('start');
    }

    protected function execute($message, $context)
    {
        global $config;

        $attach = [];

        foreach ($config['feeds'] as $alias => $command) {
            $attach[] = [
                'fallback' => 'all',
                'color' => '#36a64f',
                'title' => $command['Title'],
                'text' => 'Just type "'.$alias.'"'
            ];
        }

        $this->postMessage($config['token'], $this->getCurrentChannel(), null, 'Hello! I can help you with IT projects.', $attach);
    }
}