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
        $this->recipients = is_array($recipients) ? $recipients : [$recipients];

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
}
