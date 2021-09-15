<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\File;
use Illuminate\Testing\Fluent\AssertableJson;

class HorseAPITest extends TestCase
{
    use RefreshDatabase;

    public function testAll()
    {
        $response = $this->post('/api/v1/horse', [
            'pa_horse_id' => 1,
            'horse_name' => 'MaryJane',
            'bred' => 'GBP',
            'horse_status' => 'alive',
            'cloth_number' => 12,
            'weight_units' => 'kgs',
            'weight_value' => 300,
            'pa_jockey_id' => 32400,
            'jockey_name' => 'Jeremy',
            'pa_trainer_id' => 12351,
            'trainer_name' => 'Bob',
        ]);

        $response->assertStatus(200);
        $response->assertSee("OK");

        $response = $this->put('/api/v1/horse/0', [
            'pa_horse_id' => 1,
            'horse_name' => 'Jeremy',
            'bred' => 'GBP',
            'horse_status' => 'alive',
            'cloth_number' => 12,
            'weight_units' => 'kgs',
            'weight_value' => 300,
            'pa_jockey_id' => 32400,
            'jockey_name' => 'Jeremy',
            'pa_trainer_id' => 12351,
            'trainer_name' => 'Bob',
        ]);

        $response->assertStatus(200);
        $response->assertSee("OK");

        $response = $this->get('/api/v1/horse/0');

        $response->assertStatus(200);
        $response->assertSee("Jeremy");
        
        $response = $this->get('/api/v1/horses');

        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
                $json->has(1)
        );

        $response = $this->delete('/api/v1/horse/0');

        $response->assertStatus(200);
        $response->assertSee("OK");

        $response = $this->get('/api/v1/horses');

        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
                $json->has(0)
        );
    }
}
