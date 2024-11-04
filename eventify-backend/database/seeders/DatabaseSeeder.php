<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(7)->create(
            [
                'role' => 'u',
            ]
        );

        \App\Models\User::factory(3)->create(
            [
                'role' => 'o',
            ]
        );
        
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '12345678',
            'activated' => true,
            'email_confirmed' => true,
            'role' => 'a',
        ]);
        \App\Models\Category::factory()->create(
            [
                'name' => 'Music',
                'description' => 'Unite with music. Share your taste in a unique experience.',
            ]

        );
        \App\Models\Category::factory()->create(
            [
                'name' => 'Sports',
                'description' => 'Share your passion for sports with everyone.',
            ]
        );
        \App\Models\Category::factory()->create(
            [
                'name' => 'Technology',
                'description' => 'Discuss the latest technology trends, together.',
            ]
        );

        \App\Models\Event::factory(20)->create();
    }
}
