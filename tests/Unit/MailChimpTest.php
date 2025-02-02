<?php

namespace Tests\Unit;

use App\Facades\Mailchimp;
use Tests\TestCase;

class MailChimpTest extends TestCase
{
    private static $email;

    protected function setUp(): void
    {
        parent::setUp();

        putenv('MAILCHIMP_API_KEY=' . env('MAILCHIMP_API_KEY'));
        putenv('MAILCHIMP_LIST_ID=' . env('MAILCHIMP_LIST_ID'));
        putenv('MAILCHIMP_SERVER_PREFIX=' . env('MAILCHIMP_SERVER_PREFIX'));
    }

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$email = 'raf+' . time() . '@gmail.com';
    }

    public function testSubscribe()
    {
        $response = Mailchimp::subscribe(self::$email, 'John Doe');

        $this->assertArrayHasKey('id', $response);
        $this->assertEquals(self::$email, $response['email_address']);
        $this->assertEquals('subscribed', $response['status']);
    }

    public function testUpdateSubscriber()
    {
        $response = Mailchimp::updateSubscriber(self::$email, 'Jane Doe');

        $this->assertArrayHasKey('id', $response);
        $this->assertEquals(self::$email, $response['email_address']);
        $this->assertEquals('Jane', $response['merge_fields']['FNAME']);
        $this->assertEquals('Doe', $response['merge_fields']['LNAME']);
    }

    public function testSubscribeFails()
    {
        $response = Mailchimp::subscribe('test@test.com', 'John Doe');

        $this->assertArrayHasKey('error', $response);
    }

    public function testUpdateSubscriberFails()
    {
        $response = Mailchimp::updateSubscriber('test@test.com', 'Jane Doe');

        $this->assertArrayHasKey('error', $response);
    }
}
