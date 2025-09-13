<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                'name'  =>  'Agent',
                'email'    =>  'agent@gmail.com',
                'email_verified_at'=>now(),
                'password'=> bcrypt('12345678'),
                'created_at'   =>  now(),
                'updated_at'   =>  now(),
            ]
        ]);
    }
}
