<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name')->default('');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('path_img')->default('');
            $table->boolean('is_admin')->default(0);
            $table->boolean('ban')->default(0);
            $table->rememberToken();
            $table->timestamps();

        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('path');

        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
        });

        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('type');
            $table->string('path');

        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('street');
            $table->string('house');
            $table->double('lat')->default(48,3);
            $table->double('lng')->default(25,93);
        });

        Schema::create('restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('short_description');
            $table->longText('description');
            $table->boolean('visible')->default(1);
        });

        Schema::create('category_restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('marks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('mark');
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('day');
            $table->time('start');
            $table->time('end');
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('comment');
            $table->integer('parent_id')->default(0);
            $table->boolean('visible')->default(1);
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
