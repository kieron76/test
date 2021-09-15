<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceStaging extends Model
{
    protected $table = 'races_staging';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'pa_race_id',
        'race_date',
        'race_time',
        'runners',
        'handicap',
        'showcase',
        'trifecta',
        'stewards',
        'race_status',
        'revision',
        'weather',
        'going', 
        'meeting_id',
    ];

    public function horses() 
    {
        return $this->belongsToMany(HorseInRaceStaging::class);
    }
}
