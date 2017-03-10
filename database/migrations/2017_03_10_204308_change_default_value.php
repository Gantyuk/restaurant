<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDefaultValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table){
            $table->boolean('ban')->default(0)->change();
            $table->boolean('is_admin')->default(0)->change();
        });

        Schema::table('restaurants', function (Blueprint $table){
            $table->boolean('visible')->default(1)->change();
        });

        Schema::drop('messages');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
