<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jobs')->insert([
            ['id'=> 1 ,'job_dept'=>'Game Design','job_title'=>'Game Designer','job_role'=>'Junior Game Designer','job_salary'=>'PHP 20,000 - PHP 35,000',
            'job_desc'=>'Creates the core gameplay concepts, mechanics, and systems.','job_slots'=>'3'],

            ['id'=> 2 ,'job_dept'=>'Game Design','job_title'=>'Level Designer','job_role'=>'Senior Game Designer','job_salary'=>'PHP 50,000 - PHP 80,000',
            'job_desc'=>'Designs levels or environments in which the game is played, balancing challenges and pacing.','job_slots'=>'1'],

            ['id'=> 3 ,'job_dept'=>'Art and Animation','job_title'=>'3D Modeler','job_role'=>'Junior Animator','job_salary'=>'PHP 20,000 - PHP 35,000',
            'job_desc'=>'Creates 3D models for characters, objects, and environments.','job_slots'=>'3'],

            ['id'=> 4 ,'job_dept'=>'Art and Animation','job_title'=>'Animator','job_role'=>'Junior Animator','job_salary'=>'PHP 20,000 - PHP 35,000',
            'job_desc'=>'Brings characters and objects to life through animation.','job_slots'=>'3'],

            ['id'=> 5 ,'job_dept'=>'Programming and Engineering','job_title'=>'Gameplay Programmer','job_role'=>'Junior Programmer','job_salary'=>'PHP 20,000 - PHP 35,000',
            'job_desc'=>'Implements core game mechanics and features.','job_slots'=>'3'],

            ['id'=> 6 ,'job_dept'=>'Audio','job_title'=>'Composer','job_role'=>'Senior Composer','job_salary'=>'PHP 50,000 - PHP 80,000',
            'job_desc'=>'Writes the game\'s music and soundtracks.','job_slots'=>'1'],

            ['id'=> 7 ,'job_dept'=>'Quality Assurance','job_title'=>'QA Tester','job_role'=>'QA Tester','job_salary'=>'PHP 20,000 - PHP 35,000',
            'job_desc'=>'Tests the game for bugs, glitches, and issues.','job_slots'=>'5'],
            
            ['id'=> 8 ,'job_dept'=>'Quality Assurance','job_title'=>'QA Lead','job_role'=>'QA Lead','job_salary'=>'PHP 50,000 - PHP 80,000',
            'job_desc'=>'Manages QA testers and organizes testing efforts.','job_slots'=>'1'],

            ['id'=> 9 ,'job_dept'=>'Production and Project Management','job_title'=>'Project Manager','job_role'=>'Head of Production','job_salary'=>'PHP 250,000 - PHP 600,000+',
            'job_desc'=>'Manages the workflow and team schedules to keep the project on track.','job_slots'=>'1'],

            ['id'=> 10 ,'job_dept'=>'Marketing and Community Management','job_title'=>'Marketing Specialist','job_role'=>'Marketing Specialist','job_salary'=>'PHP 35,000 - PHP 50,000',
            'job_desc'=>'Develops and executes marketing campaigns to promote the game.','job_slots'=>'2'],

            ['id'=> 11 ,'job_dept'=>'Business and Administration','job_title'=>'Human Resources','job_role'=>'Manager','job_salary'=>'PHP 50,000 - PHP 80,000',
            'job_desc'=>'Manages hiring, company culture, and team wellbeing.','job_slots'=>'2'],
        ]);
    }
}
