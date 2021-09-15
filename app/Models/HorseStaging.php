<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorseStaging extends Model
{
    protected $table = 'horses_staging';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'pa_horse_id',
        'horse_name',
        'bred',
        'horse_status',
        'cloth_number',
        'weight_units',
        'weight_value',
        'pa_jockey_id',
        'jockey_name',
        'pa_trainer_id',
        'trainer_name',
    ];

    public function races() 
    {
        return $this->belongsToMany(HorseInRaceStaging::class);
        /*
        return $this->hasManyThrough(
            RaceStaging::class,
            HorseInRaceStaging::class,
            'race_id',
            'horse_id',
            'id',
            'id'
        );
        */
    }
}
