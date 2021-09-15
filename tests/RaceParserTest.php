<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\File;
use Classes\RaceParser;

class RaceParserTest extends TestCase
{
    use RefreshDatabase;

    public function testRaceParser()
    {
        $xml = new \SimpleXMLElement(File::get(__DIR__.'/Stubs/PA_horse_feed.xml'));

        $parser = new RaceParser($xml);
        $parser->process();


        $this->assertDatabaseHas('meetings_staging', [
            'pa_meeting_id' => 129250,
            'country' => 'Eire',
            'meeting_status' => 'Dormant',
            'meeting_date' => '2021-07-28',
            'course' => 'Galway',
            'revision' => 1,
        ]);
        $this->assertDatabaseCount('meetings_staging', 1);
          

        $this->assertDatabaseHas('races_staging', [
            'pa_race_id' => 1043591,
            'race_date' => '2021-07-28',
            'race_time' => '1636+0100',
            'runners' => 20,
            'handicap' => 1,
            'showcase' => 0,
            'trifecta' => 0,
            'stewards' => 'None',
            'race_status' => 'Dormant',
            'revision' => 2,
            'meeting_id' => 0,
        ]);
        $this->assertDatabaseCount('races_staging', 1);

        $this->assertDatabaseHas('horses_staging', [
            'pa_horse_id' => 2496725,
            'horse_name' => 'Dysart Diamond',
            'bred' => 'IRE',
            'horse_status' => 'Runner',
        ]);
        // todo complete above expectations
        $this->assertDatabaseCount('horses_staging', 21);

        $this->assertDatabaseHas('horse_in_race_staging', [
            'horse_id' => 0,
            'race_id' => 0,
        ]);
        $this->assertDatabaseCount('horse_in_race_staging', 21);


    }
}
