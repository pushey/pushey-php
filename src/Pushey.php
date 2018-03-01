<?php

namespace Pushey;

use Pushey\Messages\Message;
use Pushey\Messages\SimpleMessage;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\ClientInterface as HttpClientInterface;

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
     * @var \GuzzleHttp\ClientInterface
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
    public function __construct($token, HttpClientInterface $http = null)
    {
        if (is_null($http)) {
            $http = new HttpClient;
        }

        $this->token = $token;
        $this->http = $http;
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
    public function send($message, array $recipients = [])
    {
        if (is_string($message)) {
            $message = (new SimpleMessage)
                            ->content($message)
                            ->recipients($recipients);
        }

        // try {
            $response = $this->http->post(Pushey::API_URL, $this->buildJsonPayload($message));
        // } catch (ClientException $exception) {
        //     return false;
        // } catch (ServerException $exception) {
        //     return false;
        // } catch (TransferException $exception) {
        //     return false;
        // }

        return true;
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
            'json' => array_merge($message->toArray(), $default),
        ];
    }
}
