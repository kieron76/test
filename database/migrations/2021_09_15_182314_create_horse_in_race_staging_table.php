<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorseInRaceStagingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horse_in_race_staging', function (Blueprint $table) {

            $table->foreignId('horse_id');
            $table->foreign('horse_id')
                ->references('id')
                ->on('horses_staging');

            $table->foreignId('race_id');
            $table->foreign('race_id')
                ->references('id')
                ->on('races_staging');

            $table->primary(['horse_id', 'race_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horse_in_race_staging');
    }
}
