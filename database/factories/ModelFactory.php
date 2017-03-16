<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static  $password;
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email'=> $faker->unique()->safeEmail,
        'path_img' => $faker->imageUrl(),
        'remember_token' => str_random(10),
        'password' => $password ?: $password = bcrypt('secret'),
    ];
});


$factory->define(App\Restaurant::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->title,
        'short_description' => $faker->realText(),
        'description' => $faker->text(),
    ];
});


$factory->define(App\CategoryRestaurant::class, function (Faker\Generator $faker) {
    $id =  \DB::table('restaurants')->select('id')->inRandomOrder()->limit(1)->first();
    $cat_id =  \DB::table('categories')->select('id')->inRandomOrder()->limit(1)->first();

    return [
        'restaurant_id' => $id->id,
        'category_id' => $cat_id->id,
    ];
});


$factory->define(App\Schedule::class, function (Faker\Generator $faker) {
        $id =  \DB::table('restaurants')->select('id')->inRandomOrder()->limit(1)->first();

    return [
        'restaurant_id' => $id->id,
        'day' => rand(0,6),
        'start' => $faker->time(),
        'end'=>$faker->time(),

    ];
});

$factory->define(App\Image::class, function (Faker\Generator $faker) {
        $restaurant_id =  \DB::table('restaurants')->select('id')->inRandomOrder()->limit(1)->first();
    return [
        'restaurant_id' => $restaurant_id->id,
        'path' => $faker->imageUrl(),

    ];
});
$factory->define(App\Mark::class, function (Faker\Generator $faker) {
        $restaurant_id =  \DB::table('restaurants')->select('id')->inRandomOrder()->limit(1)->first();
        $user_id =  \DB::table('users')->select('id')->inRandomOrder()->limit(1)->first();
    return [
        'restaurant_id' => $restaurant_id->id,
        'user_id' => $user_id->id,
        'mark'=>rand(0,5)

    ];
});

$factory->define(App\Document::class, function (Faker\Generator $faker) {
        $restaurant_id =  \DB::table('restaurants')->select('id')->inRandomOrder()->limit(1)->first();
    return [
        'type' => $faker->fileExtension,
        'path' =>"path",
        'restaurant_id'=>$restaurant_id->id,

    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
        $restaurant_id =  \DB::table('restaurants')->select('id')->inRandomOrder()->limit(1)->first();
        $user_id =  \DB::table('users')->select('id')->inRandomOrder()->limit(1)->first();
    return [
        'comment' => $faker->text(),
        'user_id' =>$user_id->id,
        'restaurant_id'=>$restaurant_id->id,
        'parent'=>random_int(15, 60)

    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->text(6),
    ];
});
