<?php

namespace App\Services;

use GuzzleHttp\Client;

class MailchimpService
{
    protected $client;
    protected $apiKey;
    protected $listId;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('MAILCHIMP_API_KEY');
        $this->listId = env('MAILCHIMP_LIST_ID');
    }

    public function subscribe($email, $name)
    {
        $response = $this->client->request('POST', "https://usX.api.mailchimp.com/3.0/lists/{$this->listId}/members", [
            'auth' => ['user', $this->apiKey],
            'json' => [
                'email_address' => $email,
                'status' => 'subscribed',
                'merge_fields' => ['FNAME' => $name],
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
