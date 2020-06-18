<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'email' => 'alexey.serbi@mail.com',
                'password' => bcrypt(123456)
            ],
            [
                'id' => 2,
                'email' => 'teacher@mail.com',
                'password' => bcrypt(123456)
            ],
            [
                'id' => 3,
                'email' => 'alex@mail.com',
                'password' => bcrypt(123456)
            ],
        ]);
    }
}
