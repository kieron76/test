<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorseInRaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //lazyness - change to concrete definition once we've settled on what the app domain tables will look like
        \DB::statement("CREATE TABLE horse_in_race AS SELECT * FROM horse_in_race_staging");
        \DB::statement("DELETE FROM horse_in_race");
        \DB::statement("ALTER TABLE horse_in_race ADD PRIMARY KEY (race_id, horse_id)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horse_in_race');
    }
}
