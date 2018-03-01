<?php

use Pushey\Pushey;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testSendMessage()
    {
        $pushey = new Pushey(
            'secret',
            $http = Mockery::mock('GuzzleHttp\Client')
        );

        $http->shouldReceive('post')
            ->once()
            ->andReturn(new Response(201));

        $sent = $pushey->send('test', ['test@example.org']);

        $this->assertTrue($sent);
    }
}
