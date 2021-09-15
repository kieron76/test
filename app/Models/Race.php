<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $table = 'races';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'pa_race_id',
        'race_date',
        'runners',
        'handicap',
        'showcase',
        'race_status',
        'meeting_id',
    ];

    public function horses() 
    {
        return $this->belongsToMany(HorseInRace::class);
    }
}