<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Level;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

         $this->call([
            UserSeeder::class,
        ]);

       
            Level::create([
                "name"=> "Beginner",
                "text" => "Beginner Level",
            ]);
             Category::create([
                "name"=> "Laravel",
                "text" => "Laravel 11",
             ]);
       
    }
}
