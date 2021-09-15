<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //lazyness - change to concrete definition once we've settled on what the app domain tables will look like
        \DB::statement("CREATE TABLE horses AS SELECT * FROM horses_staging");
        \DB::statement("DELETE FROM horses");
        \DB::statement("ALTER TABLE horses ADD PRIMARY KEY (id)");
        // hmm
        \DB::statement("ALTER TABLE horses ADD UNIQUE KEY (pa_horse_id)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horses');
    }
}
