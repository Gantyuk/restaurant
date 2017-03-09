<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table){
            $table->integer('restaurant_id')->unsigned();

            $table->foreign('restaurant_id')->references('id')->on('restaurants');
        });

        Schema::table('documents', function (Blueprint $table){
            $table->integer('restaurant_id')->unsigned();

            $table->foreign('restaurant_id')->references('id')->on('restaurants');
        });

        Schema::table('addresses', function (Blueprint $table){
            $table->integer('restaurant_id')->unsigned();

            $table->foreign('restaurant_id')->references('id')->on('restaurants');
        });

        Schema::table('category_restaurants', function (Blueprint $table) {
            $table->integer('restaurant_id')->unsigned();
            $table->integer('category_id')->unsigned();

            $table->foreign('restaurant_id')->references('id')->on('restaurants');
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::table('marks', function (Blueprint $table) {
            $table->integer('restaurant_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('restaurant_id')->references('id')->on('restaurants');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('schedules', function (Blueprint $table) {
            $table->integer('restaurant_id')->unsigned();

            $table->foreign('restaurant_id')->references('id')->on('restaurants');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->integer('restaurant_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('restaurant_id')->references('id')->on('restaurants');
            $table->foreign('user_id')->references('id')->on('users');
        });
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
