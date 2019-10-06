<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skillables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('skill_id')->unsigned();
            $table->bigInteger('skillable_id')->unsigned();
            $table->string('skillable_type');
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
        Schema::dropIfExists('skillables');
    }
}
