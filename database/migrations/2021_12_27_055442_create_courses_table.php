<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('content');
            $table->string('pic1');
            $table->string('pic2')->nullable();
            $table->string('pic3')->nullable();
            $table->string('price');
            $table->string('notice')->nullable();
            $table->string('place');
            $table->string('course_start_time');
            $table->string('course_send_time');
            $table->string('signUp_start_time');
            $table->string('signUp_end_time');
            $table->string('class1');
            $table->string('class2')->nullable();
            $table->string('class3')->nullable();
            $table->integer('usernum')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}