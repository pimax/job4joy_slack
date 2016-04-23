<?php

namespace pimax\slackbot;


abstract class AdvancedCommand extends \PhpSlackBot\Command\BaseCommand
{
    protected function postMessage($token, $channel, $username, $message, $attachments = [])
    {
        $response = array(
            'token' => $token,
            'as_user' => true,
            'id' => time(),
            'type' => 'message',
            'channel' => $channel,
            'text' => (!is_null($username) ? '<@'.$username.'> ' : '').$message
        );

        if (!empty($attachments)) {
            $response['attachments'] = json_encode($attachments);
        }

        $url = 'https://slack.com/api/chat.postMessage';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($response));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $body = curl_exec($ch);
        if ($body === false) {
            throw new \Exception('Error when requesting '.$url.' '.curl_error($ch));
        }
        curl_close($ch);
        $response = json_decode($body, true);
        if (is_null($response)) {
            throw new \Exception('Error when decoding body ('.$body.').');
        }
        if (isset($response['error'])) {
            throw new \Exception($response['error']);
        }


        return $response;
    }
}