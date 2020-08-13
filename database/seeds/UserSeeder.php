<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create()->each(function($user)
        {
            $cars = factory(App\cars::class)->make();
            $cars->user_id = $user->id;
            $cars->request = 1;
            $cars->mot_time = Carbon::now()->toDateTimeString();
            $cars->save();
            $image = factory(App\images::class)->make();
            $cars->image()->create(['name'=>$image->name, 'url'=>$image->url]);
            $user->image()->create(['name'=>$image->name, 'url'=>$image->url]);


        });

        factory(App\Role::class)->create()->each(function($role){
            $ability = factory(App\Ability::class)->create();
            $role->allowTo($ability);
        });

    }
}

// add images to seeder
