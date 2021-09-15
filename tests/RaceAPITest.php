<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\File;
use Illuminate\Testing\Fluent\AssertableJson;

class RaceAPITest extends TestCase
{
    use RefreshDatabase;

    public function testAll()
    {
        $response = $this->post('/api/v1/race', [
            'pa_race_id' => 1,
            'race_date' => '2018-08-19',
            'runners' => 10,
            'handicap' => 1,
            'showcase' => 0,
            'race_status' => 'Abandoned',
            'meeting_id' => 0,
        ]);

        $response->assertStatus(200);
        $response->assertSee("OK");

        $response = $this->put('/api/v1/race/0', [
            'pa_race_id' => 1,
            'race_date' => '2018-08-19',
            'runners' => 12,
            'handicap' => 1,
            'showcase' => 0,
            'race_status' => 'Back On',
            'meeting_id' => 0,
        ]);

        $response->assertStatus(200);
        $response->assertSee("OK");

        $response = $this->get('/api/v1/race/0');

        $response->assertStatus(200);
        $response->assertSee("Back On");
        
        $response = $this->get('/api/v1/race');

        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
                $json->has(1)
        );

        $response = $this->delete('/api/v1/race/0');

        $response->assertStatus(200);
        $response->assertSee("OK");

        $response = $this->get('/api/v1/race');

        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
                $json->has(0)
        );
    }
}
