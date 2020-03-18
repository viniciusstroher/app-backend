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
        //
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@app.com',
            'password' => bcrypt('password'),
            'api_token' => Str::random(60)
        ]);

        DB::table('users')->insert([
            'name' => 'User 1',
            'email' => 'user1@app.com',
            'password' => bcrypt('123'),
            'api_token' => Str::random(60)
        ]);

        DB::table('users')->insert([
            'name' => 'User 2',
            'email' => 'user2@app.com',
            'password' => bcrypt('123'),
            'api_token' => Str::random(60)
        ]);

        DB::table('users')->insert([
            'name' => 'User 3',
            'email' => 'user3@app.com',
            'password' => bcrypt('123'),
            'api_token' => Str::random(60)
        ]);
    }
}
