<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacesStagingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races_staging', function (Blueprint $table) {
            $table->id();

            // our db will pretty much be inline with pa
            // but its bad practice to rely on an external id
            // we may find that the id is duplicated in some circumastanes
            // if this is the case then this will need to be unique with another
            // field. i.e. datetime
            $table->integer('pa_race_id');
            $table->date('race_date');

            $table->time('race_time')
                ->nullable();

            $table->tinyInteger('runners')
                ->nullable();
            // looks like a boolean, could change
            $table->boolean('handicap')
                ->nullable();
            $table->boolean('showcase')
                ->nullable();
            $table->boolean('trifecta')
                ->nullable();

            $table->string('stewards', 20)
                ->nullable();
            $table->string('race_status', 20)
                ->nullable();

            $table->tinyInteger('revision')
                ->nullable();

            // look like long desriptions
            // could be increased in size to text
            $table->string('weather')
                ->nullable();
            $table->string('going_brief')
                ->nullable();

            $table->tinyInteger('process_status')
                ->default(0);

            $table->foreignId('meeting_id');
            $table->foreign('meeting_id')
                ->references('id')
                ->on('meetings_staging');




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
        Schema::dropIfExists('races_staging');
    }
}
