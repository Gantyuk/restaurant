<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Address
 *
 * @property-read \App\Restaurant $restaurant
 */
	class Address extends \Eloquent {}
}

namespace App{
/**
 * App\Category
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Restaurant[] $restaurants
 */
	class Category extends \Eloquent {}
}

namespace App{
/**
 * App\CategoryRestaurant
 *
 */
	class CategoryRestaurant extends \Eloquent {}
}

namespace App{
/**
 * App\Comment
 *
 * @property-read \App\Restaurant $restaurant
 * @property-read \App\User $user
 */
	class Comment extends \Eloquent {}
}

namespace App{
/**
 * App\Document
 *
 * @property-read \App\Restaurant $restaurant
 */
	class Document extends \Eloquent {}
}

namespace App{
/**
 * App\Image
 *
 * @property-read \App\Restaurant $restaurant
 */
	class Image extends \Eloquent {}
}

namespace App{
/**
 * App\Mark
 *
 * @property-read \App\Restaurant $restaurant
 * @property-read \App\User $user
 */
	class Mark extends \Eloquent {}
}

namespace App{
/**
 * App\Restaurant
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Address[] $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Document[] $documents
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Image[] $images
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Mark[] $marks
 * @property-read \App\Schedule $schedule
 */
	class Restaurant extends \Eloquent {}
}

namespace App{
/**
 * App\Schedule
 *
 * @property-read \App\Restaurant $restaurant
 */
	class Schedule extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Mark[] $marks
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 */
	class User extends \Eloquent {}
}

