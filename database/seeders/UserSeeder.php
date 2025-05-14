<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['id'=> 1 ,'first_name'=>'Jemmel','last_name'=>'Villanueva','username'=>'jemmel_v','password'=>Hash::make('Password'),'user_type'=>'admin'],

            ['id'=> 2 ,'first_name'=>'Maulvi','last_name'=>'Limpao','username'=>'mjinn_','password'=>Hash::make('test123'),'user_type'=>'admin'],

            ['id'=> 3 ,'first_name'=>'Ryan','last_name'=>'Giray','username'=>'ryanglenn','password'=>Hash::make('barangay'),'user_type'=>'admin'],

            ['id'=> 4 ,'first_name'=>'Jemz','last_name'=>'Hernalin','username'=>'jemz','password'=>Hash::make('123'),'user_type'=>'admin'],

            ['id'=> 5 ,'first_name'=>'Jungkook','last_name'=>'Jeon','username'=>'jjk_97','password'=>Hash::make('Lezgetit'),'user_type'=>'applicant'],

            ['id'=> 6 ,'first_name'=>'Seokjin','last_name'=>'Kim','username'=>'jin','password'=>Hash::make('SuperTuna'),'user_type'=>'applicant']
        ]);
    }
}
