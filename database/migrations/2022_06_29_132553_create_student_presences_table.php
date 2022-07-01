<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPresencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->references('id')->on('students')->onDelete('cascade');
            $table->time('schedule_time_in')->nullable();
            $table->time('schedule_time_out')->nullable();
            $table->time('in')->nullable();
            $table->time('out')->nullable();
            $table->string('coordinate_in')->nullable();
            $table->string('coordinate_out')->nullable();
            $table->enum('is_free',['yes','no'])->default('no');
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
        Schema::dropIfExists('student_presences');
    }
}
