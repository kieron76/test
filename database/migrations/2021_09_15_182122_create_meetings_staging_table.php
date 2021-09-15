<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsStagingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings_staging', function (Blueprint $table) {
            $table->id();

            $table->integer('pa_meeting_id');

            // could be its own table
            $table->string('country', 20)
                ->nullable();

            $table->string('meeting_status', 20)
                ->nullable();
            $table->date('meeting_date')
                ->nullable();

            $table->string('course', 20)
                ->nullable();

            $table->tinyInteger('revision')
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
        Schema::dropIfExists('meetings_staging');
    }
}
