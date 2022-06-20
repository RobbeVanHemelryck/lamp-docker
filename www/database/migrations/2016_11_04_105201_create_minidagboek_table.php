<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinidagboekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minidagboek', function (Blueprint $table) {
            $table->date('datum');
            $table->string('weekdag', 2);
            $table->string('muziek', 100);
            $table->longText('gebeurtenis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('minidagboek');
    }
}
