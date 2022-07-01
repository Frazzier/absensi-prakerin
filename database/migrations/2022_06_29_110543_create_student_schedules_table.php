<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->references('id')->on('students')->onDelete('cascade');
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->time('sunday_in')->nullable();
            $table->time('sunday_out')->nullable();
            $table->time('monday_in')->nullable();
            $table->time('monday_out')->nullable();
            $table->time('tuesday_in')->nullable();
            $table->time('tuesday_out')->nullable();
            $table->time('wednesday_in')->nullable();
            $table->time('wednesday_out')->nullable();
            $table->time('thursday_in')->nullable();
            $table->time('thursday_out')->nullable();
            $table->time('friday_in')->nullable();
            $table->time('friday_out')->nullable();
            $table->time('saturday_in')->nullable();
            $table->time('saturday_out')->nullable();
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
        Schema::dropIfExists('student_schedules');
    }
}
