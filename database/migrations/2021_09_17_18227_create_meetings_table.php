<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //lazyness - change to concrete definition once we've settled on what the app domain tables will look like
        \DB::statement("CREATE TABLE meetings AS SELECT * FROM meetings_staging");
        \DB::statement("DELETE FROM meetings");
        \DB::statement("ALTER TABLE meetings ADD PRIMARY KEY (id)");
        // I'm sure there is something written in the pa docs about using a compound key here
        \DB::statement("ALTER TABLE meetings ADD UNIQUE KEY (pa_meeting_id)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
}
