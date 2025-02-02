<?php

namespace Tests\Feature;

use Tests\TestCase;

class LeadPaginationTest extends TestCase
{
    /** @test */
    public function it_fetches_paginated_leads()
    {
        $perPage = env('LEADS_PER_PAGE', 5);

        $response = $this->getJson('/api/leads?page=2');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'current_page', 'data', 'last_page', 'total'
                 ]);

        $this->assertCount($perPage, $response->json('data'));
    }
}
