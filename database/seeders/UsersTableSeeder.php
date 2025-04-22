<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['id'=> 1 ,'first_name'=>'Jemmel','last_name'=>'Villanueva','username'=>'jemmel_v','password'=>'Password','user_type'=>'admin']
        ]);
    }
}
