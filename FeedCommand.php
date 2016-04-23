<?php

namespace pimax\slackbot;

use PicoFeed\Reader\Reader;

abstract class FeedCommand extends AdvancedCommand
{
    protected function getFeed($feed, $token)
    {
        try {
            $reader = new Reader;
            $resource = $reader->download($feed);
            $parser = $reader->getParser(
                $resource->getUrl(),
                $resource->getContent(),
                $resource->getEncoding()
            );
            $feed = $parser->execute();
            $items = array_reverse($feed->getItems());
            if (count($items))
            {
                foreach ($items as $itm)
                {
                    $url = $itm->getUrl();
                    $message = substr(strip_tags($itm->getContent()), 0, 150);

                    $this->postMessage($token, $this->getCurrentChannel(), null, '', [
                        [
                            'title' => $itm->getTitle(),
                            'title_link' => $url,
                            'text' => $message
                        ]
                    ]);
                }
            } else {
                $this->getClient()->send($this->getCurrentChannel(), null, 'Not found a new projects.');
            }
        }
        catch (Exception $e) {

        }

        return true;
    }
}