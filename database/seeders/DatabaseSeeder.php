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
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory(1000)->create(
            [
                'role' => 1
            ]
        );
        User::factory(95)->create([
            'role' => 2
        ]);

        $catOne = Category::factory(7)->create([
            'created_by' => 'administrators',
        ]);
        $catTwo = Category::factory(22)->create([
            'created_by' => 'users',
        ]);

        Business::factory(35)->create();

        Product::factory(555)->create();
    }
}
