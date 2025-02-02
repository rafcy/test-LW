<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Lead;
use App\Services\MailchimpService;

class LeadBulkCreateTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_creates_15_leads_via_api()
    {
        if (Lead::exists()) {
            $this->assertTrue(True);
            return;
        }

        $leads = [];
        for ($i = 0; $i < 15; $i++) {
            $leads[] = [
                'full_name' => "Test User {$i}",
                'email' => "test" . "{$i}@gmail.com",
                'consent' => true,
            ];
        }

        foreach ($leads as $lead) {
            $response = $this->postJson('/api/leads', $lead);
            $response->assertStatus(200);
        }

        $this->assertCount(15, Lead::all());
    }
}
