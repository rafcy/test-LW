<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MailchimpService
{
    protected $apiKey;
    protected $apiUrl;
    protected $listId;
    protected $serverPrefix;

    public function __construct()
    {
        $this->apiKey = env('MAILCHIMP_API_KEY');
        $this->listId = env('MAILCHIMP_LIST_ID');
        $this->serverPrefix = env('MAILCHIMP_SERVER_PREFIX');
        $this->apiUrl = "https://{$this->serverPrefix}.api.mailchimp.com/3.0/lists/{$this->listId}/members";
    }

    /**
     * Subscribe a user to Mailchimp list.
     *
     * @param string $email
     * @param string $fullName
     * @return array
     */
    public function subscribe(string $email, string $fullName): array
    {
        $names = $this->splitFullName($fullName);

        try {
            $response = Http::acceptJson()
                ->withToken($this->apiKey)
                ->post($this->apiUrl, [
                    'email_address' => $email,
                    'status' => 'subscribed',
                    'merge_fields' => [
                        'FNAME' => $names['first_name'],
                        'LNAME' => $names['last_name']
                    ],
                ]);

            if ($response->status() !== 200) {
                Log::error('Mailchimp API Error: ', [
                    'email' => $email,
                    'fullName' => $fullName,
                    'status' => $response->status(),
                    'response' => $response->json(),
                ]);

                return ['error' => 'Failed to subscribe to Mailchimp'];
            }

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            Log::error('Mailchimp API Error: ', [
                'email' => $email,
                'fullName' => $fullName,
                'error' => $e->getMessage()
            ]);

            return ['error' => 'Failed to subscribe to Mailchimp'];
        }
    }

    /**
     * Update an existing Mailchimp subscriber.
     *
     * @param string $email
     * @param string $fullName
     * @return array
     */
    public function updateSubscriber(string $email, string $fullName): array
    {
        $subscriberHash = md5(strtolower($email));
        $names = $this->splitFullName($fullName);

        $url = "{$this->apiUrl}/{$subscriberHash}";

        try {
            $response = Http::acceptJson()
                ->withToken($this->apiKey)->put($url, [
                    'merge_fields' => [
                        'FNAME' => $names['first_name'],
                        'LNAME' => $names['last_name']
                    ]
                ]);

            if ($response->status() !== 200) {
                Log::error('Mailchimp API Error: ', [
                    'email' => $email,
                    'fullName' => $fullName,
                    'status' => $response->status(),
                    'response' => $response->json(),
                ]);

                return ['error' => 'Failed to subscribe to Mailchimp'];
            }

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            Log::error('Mailchimp API Update Error: ', [
                'email' => $email,
                'fullName' => $fullName,
                'error' => $e->getMessage()
            ]);

            return ['error' => 'Failed to update Mailchimp subscriber'];
        }
    }

    private function splitFullName(string $fullName): array
    {
        $nameParts = preg_split('/\s+/', trim($fullName), 2);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';

        return ['first_name' => $firstName, 'last_name' => $lastName];
    }
}
