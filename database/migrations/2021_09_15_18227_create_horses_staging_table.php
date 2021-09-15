<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorsesStagingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horses_staging', function (Blueprint $table) {
            $table->id();

            // our db will pretty much be inline with pa
            // but its bad practice to rely on an external id
            // we may find that the id is duplicated in some circumastanes
            // if this is the case then this will need to be unique with another
            $table->integer('pa_horse_id');

            $table->string('horse_name', 30)
                ->nullable();
            $table->string('bred', 5)
                ->nullable();
            $table->string('horse_status', 10)
                ->nullable();
            // coupled horeses may have a letter in their
            // cloth number
            $table->string('cloth_number')
                ->nullable();
            $table->string('weight_units')
                ->nullable();
            $table->string('weight_value')
                ->nullable();
            // ignore weight text as this is derivable from above

            // may potentially be moved out into their own tables
            // if later deemed necessary
            $table->integer('pa_jockey_id')
                ->nullable();
            $table->string('jockey_name')
                ->nullable();
            $table->integer('pa_trainer_id')
                ->nullable();
            $table->string('trainer_name')
                ->nullable();

            $table->tinyInteger('process_status')
                ->default(0);
            
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
        Schema::dropIfExists('horses_staging');
    }
}
