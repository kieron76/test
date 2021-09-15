<?php

namespace App\Classes;

use App\Models\MeetingStaging;
use App\Models\HorseStaging;
use App\Models\RaceStaging;
use Carbon\Carbon;

class RaceParser 
{
    protected \SimpleXMLElement $xmlToParse;

    public function __construct(\SimpleXMLElement $xml) 
    {
        $this->xmlToParse = $xml;
        return $this;
    }

    public function process() 
    {
        $meetingXml = $this->xmlToParse->Meeting;

        if (!$meetingXml) {
            //no meeting? 
            return;
        }

        $meeting = new MeetingStaging();
        $meeting->fill([
            // attributes
            'pa_meeting_id' => (int)$meetingXml['id'],
            'country'=> (string)$meetingXml['country'],
            'meeting_status' => (string)$meetingXml['status'],
            'meeting_date' => Carbon::createFromFormat('Ymd',(string)$meetingXml['date'] ?? ''),
            'course' => (string)$meetingXml['course'] ?? '',
            'revision' => (int)$meetingXml['revision'] ?? 0,
        ]);
        $meeting->save();

        if ($race = $meetingXml->Race) {
            $races = $this->processRaces($race, $meeting->id);
        }
    }

    protected function processRaces($raceXml, $meeting_id)
    {
        $returnRaces = [];
        foreach ($raceXml as $raceXml) {
            $race = new RaceStaging();

            $race->fill([
                'pa_race_id' => (int)$raceXml['id'] ?? 0,
                'race_date' => Carbon::createFromFormat('Ymd',(string)$raceXml['date'] ?? ''),
                //TODO: fix this
                //'race_time' => Carbon::createFromFormat('HisO',(string)$raceXml['time'] ?? '', 'Europe/London'),
                'runners' => (int)$raceXml['runners'] ?? 0,
                'handicap' => (string)$raceXml['handicap'] == 'Yes' ? 1 : 0,
                'showcase' => (string)$raceXml['showcase'] == 'Yes' ? 1 : 0,
                'trifecta' => (string)$raceXml['trifecta'] == 'Yes' ? 1 : 0,
                'stewards' => (string)$raceXml['stewards'] ?? '',
                'race_status' => (string)$raceXml['status'] ?? '',
                'revision' => (int)$raceXml['revision'] ?? 0,
                'weather' => (string)$raceXml->Weather ?? '',
                'going_brief' => (string)$raceXml->Going['brief'] ?? '',
                // yuck
                'meeting_id' => $meeting_id,
            ]);

            $race->save();

            $returnRaces[] = $race;

            if ($horses = $raceXml->Horse) {
                $horses = $this->processHorses($horses);
                $race->horses()->attach($horses);
            }

        }

        return $returnRaces;

    }

    protected function processHorses($horses) 
    {
        $returnHorses = [];
        foreach ($horses as $horseXml) {
            $horse = new HorseStaging();
            $horse->fill([
                'pa_horse_id' => (int)$horseXml['id'],
                'horse_name' => (string)$horseXml['name'] ?? '',
                'horse_status' => (string)$horseXml['status'] ?? '',

                'cloth_number' => (int)$horseXml->Cloth['number'] ?? 0,

                'weight_units' => (string)$horseXml->Weight['units'] ?? '',
                'weight_value' => (int)$horseXml->Weight['value'] ?? 0,

                'pa_jockey_id' => (int)$horseXml->Jockey['id'] ?? '',
                'jockey_name' => (string)$horseXml->Jockey['name'] ?? '',
                'pa_trainer_id' => (int)$horseXml->Trainer['id'] ?? 0,
                'trainer_name' => (string)$horseXml->Trainer['name'] ?? '',
            ]);

            $horse->save();

            $returnHorses[] = $horse;
        }

        return $returnHorses;
    }
}