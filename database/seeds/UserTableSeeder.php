<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'email' => 'dung1212@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
