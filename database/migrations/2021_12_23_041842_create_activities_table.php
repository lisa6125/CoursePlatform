<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('who_create');
            $table->string('content');
            $table->string('pic1');
            $table->string('pic2')->nullable();
            $table->string('pic3')->nullable();
            $table->string('price');
            $table->string('notice')->nullable();
            $table->string('place');
            $table->string('activity_start_time');
            $table->string('activity_send_time');
            $table->string('signUp_start_time');
            $table->string('signUp_end_time');
            $table->string('connect_user_phone');
            $table->string('connect_user_email');
            $table->string('connect_user_pic');
            $table->string('condition');
            $table->enum('state',['審核','召集中','確認開團','開團失敗'])->default('審核');
            $table->string('class1');
            $table->string('class2')->nullable();
            $table->string('class3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
