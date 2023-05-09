<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     
     */
    
    public function run()
    {
        $faker = Factory::create();
        $hash = $faker->unique()->password();


       for($i = 1; $i <= 10; $i++){
            DB::table('users')->insert([
                'name' =>  $faker->name,
                'email' =>  $faker->email,
                'email_verified_at' => now(),
                'password' =>  Hash::make(11111111),
                'created_at'=> now()
            ]);
        }
    }
}