<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ScheduleContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_contents', function (Blueprint $table) {
            // user_id, image, description, schedule_on, status, created_at, updated_at
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('image');
            $table->text('description');
            $table->dateTime('schedule_on')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('schedule_contents');
    }
}
