<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $user = new User();
        $user->email='admin@gmail.com';
        $user->name='admin';
        $user->nivel='1';
        $user->password=bcrypt('admin');
        $user->save();
    }
}
