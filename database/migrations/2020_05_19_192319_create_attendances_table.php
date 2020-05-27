<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
              $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('instructor_id')->unsigned()->nullable();
              $table->bigInteger('course_id')->unsigned()->nullable();
              $table->date('attendance_date');
                $table->time('attendance_time');

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
        Schema::dropIfExists('attendances');
    }
}
