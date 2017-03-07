<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class,100)->create();
        factory(App\Restaurant::class,100)->create();
        factory(App\Schedule::class,100)->create();
        factory(App\Mark::class,100)->create();
        factory(App\Image::class,100)->create();
        factory(App\Document::class,100)->create();
        factory(App\Comment::class,100)->create();
        factory(App\Category::class,100)->create();

    }
}
