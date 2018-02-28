<?php

namespace Pushey;

use GuzzleHttp\Client as HttpClient;
use Pushey\Messages\Message;
use Pushey\Messages\SimpleMessage;

class Pushey
{
    /**
     * The url of the API.
     *
     * @var string
     */
    const API_URL = 'https://api.pushey.com/messages';

    /**
     * The HTTP client instance.
     *
     * @var \GuzzleHttp\Client
     */
    protected $http;

    /**
     * The channel API token.
     *
     * @var string
     */
    protected $token;

    /**
     * Create a new Pushey instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->http = new HttpClient;
        $this->token = $token;
    }

    /**
     * Set the channel API token.
     *
     * @param  string  $token
     * @return void
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Send the given message.
     *
     * @param  mixed  $message
     * @param  array  $recipients
     * @return bool
     */
    public function send($message, $recipients = [])
    {
        if (! $message instanceof Message) {
            $message = (new SimpleMessage)
                            ->content($message)
                            ->recipients($recipients);
        }

        $this->http->post(Pushey::API_URL, $this->buildJsonPayload($message));
    }

    /**
     * Build up a JSON payload for the request.
     *
     * @param  \Pushey\Messages\Message  $message
     * @return array
     */
    protected function buildJsonPayload(Message $message)
    {
        $default = array_filter([
            'token' => $this->token,
        ]);

        return [
            'json' => array_merge([
                'content' => $message->content,
                'recipients' => $message->recipients,
            ], $default),
        ];
    }
}
