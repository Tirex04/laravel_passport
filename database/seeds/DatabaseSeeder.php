<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class, 50)->create()->each(function($user){
            for($i = 0; $i < rand(5,10); $i++){
                $user->articles()->save(factory(App\Article::class)->make());
            }
        });
    }
}
