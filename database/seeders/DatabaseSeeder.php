<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory(1500)->create();
        // User::factory(95)->create([
        //     'role' => 2
        // ]);

        $catOne = Category::factory(2)->create([
            'created_by' => 'administrators',
        ]);
        $catTwo = Category::factory(3)->create([
            'created_by' => 'users',
        ]);

        Business::factory(25)->create();

        Product::factory(255)->create();
    }
}
