<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewCloumnUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::table('users', function (Blueprint $table) {
            $table->integer('courseyoujoin')->nullable();
            $table->integer('courseyouopen')->nullable();
            $table->integer('activityyoujoin')->nullable();
            $table->integer('activityyouopen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('courseyoujoin');
            $table->dropColumn('courseyouopen');
            $table->dropColumn('activityyoujoin');
            $table->dropColumn('activityyouopen');

        });
    }
}