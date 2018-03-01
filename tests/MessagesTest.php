<?php

use PHPUnit\Framework\TestCase;
use Pushey\Messages\SimpleMessage;

class MessagesTest extends TestCase
{
    public function testSimpleMessage()
    {
        $content = 'content';
        $recipient = 'test@example.org';

        $message = (new SimpleMessage)
            ->content($content)
            ->recipients($recipient);

        $payload = $message->toArray();

        $this->assertSame($content, $payload['text']);
        $this->assertInternalType('array', $payload['recipients']);
        $this->assertContains($recipient, $payload['recipients']);
    }
}
