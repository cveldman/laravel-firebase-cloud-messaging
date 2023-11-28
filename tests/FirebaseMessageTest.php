<?php

namespace Veldman\FirebaseCloudMessaging\Tests;


use PHPUnit\Framework\TestCase;
use Veldman\FirebaseCloudMessaging\FirebaseMessage;

class FirebaseMessageTest extends TestCase
{
    public function testCanSetTitle()
    {
        $message = new FirebaseMessage;

        $result = $message->title('Title');

        $this->assertEquals('Title', $message->title);
        $this->assertEquals($message, $result);
    }

    public function testCanSetBody()
    {
        $message = new FirebaseMessage;

        $result = $message->body('Lorem ipsum');

        $this->assertEquals('Lorem ipsum', $message->body);
        $this->assertEquals($message, $result);
    }
}