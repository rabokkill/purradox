<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['id'=> 1 ,'first_name'=>'Jemmel','last_name'=>'Villanueva','username'=>'jemmel_v','password'=>Hash::make('Password')],
            ['id'=> 2 ,'first_name'=>'Maulvi','last_name'=>'Limpao','username'=>'mjinn_','password'=>Hash::make('test123')],
            ['id'=> 3 ,'first_name'=>'Ryan','last_name'=>'Giray','username'=>'ryanglenn','password'=>Hash::make('barangay')],
            ['id'=> 4 ,'first_name'=>'Jemz','last_name'=>'Hernalin','username'=>'jemz','password'=>Hash::make('123')]
        ]);
    }
}
