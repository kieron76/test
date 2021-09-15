<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingStaging extends Model
{
    protected $table = 'meetings_staging';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'pa_meeting_id',
        'country',
        'meeting_status',
        'meeting_date',
        'course',
        'revision',
    ];

    public function races() 
    {
        return $this->hasMany(RaceStaging::class);
    }
}
