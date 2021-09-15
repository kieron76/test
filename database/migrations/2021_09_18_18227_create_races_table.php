<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //lazyness - change to concrete definition once we've settled on what the app domain tables will look like
        \DB::statement("CREATE TABLE races AS SELECT * FROM races_staging");
        \DB::statement("DELETE FROM races");
        \DB::statement("ALTER TABLE races ADD PRIMARY KEY (id)");
        // I'm sure there is something written in the pa docs about using a compound key here
        \DB::statement("ALTER TABLE races ADD UNIQUE KEY (pa_race_id, race_time)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('races');
    }
}
