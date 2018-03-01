<?php

namespace Pushey\Messages;

abstract class Message
{
    /**
     * The recipients of the message.
     *
     * @var array
     */
    public $recipients = [];

    /**
     * The text content of the message.
     *
     * @var string
     */
    public $content;

    /**
     * Set the recipients of the message.
     *
     * @param  string|array  $address
     * @return $this
     */
    public function recipients($recipients)
    {
        $this->recipients = (array) $recipients;

        return $this;
    }

    /**
     * Set the content of the message.
     *
     * @param  string  $content
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get an array representation of the message.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'text' => $this->content,
            'recipients' => $this->recipients,
        ];
    }
}
