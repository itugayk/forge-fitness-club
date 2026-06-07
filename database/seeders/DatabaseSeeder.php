<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@forgefitness.com'],
            ['name' => 'Forge Admin', 'password' => bcrypt('password')],
        );

        $this->call([
            ClassCategorySeeder::class,
            TrainerSeeder::class,
            MembershipPlanSeeder::class,
            ServiceSeeder::class,
            ClassScheduleSeeder::class,
            TestimonialSeeder::class,
            GalleryImageSeeder::class,
            PostSeeder::class,
            DemoSubmissionsSeeder::class,
        ]);
    }
}
