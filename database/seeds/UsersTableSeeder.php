<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
            'name' => 'Иванов Иван Иванович',
            'login' => 'user1',
            'email' => 'user1@gmail.com',
            'phone' => '+7 (923) 456-67-78',
            'password' => bcrypt('12345678'),
            'type' => 1,
            'is_admin' => false,
            'created_at' => '2016-06-14 22:03:57'
        ]);

        DB::table('users')->insert([
            'name' => 'Петров Петр Петрович',
            'login' => 'user2',
            'email' => 'user2@gmail.com',
            'phone' => '+7 (923) 456-67-78',
            'password' => bcrypt('12345678'),
            'type' => 2,
            'is_admin' => false,
            'created_at' => '2016-06-14 22:03:57'
        ]);

        DB::table('users')->insert([
            'name' => 'Админ Админович',
            'login' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '+7 (923) 456-67-78',
            'password' => bcrypt('12345678'),
            'is_admin' => true,
            'created_at' => '2016-06-14 22:03:57'
        ]);
    }
}
