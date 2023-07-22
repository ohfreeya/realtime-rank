<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Team;
use App\Models\User;
use Faker\Guesser\Name;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $staff = Team::create([
            "name" => "Staff Manager Team",
            "score" => 0,
        ]);
        User::create([
            "name" => "Admin",
            "email" => "root@admin",
            "password" => Hash::make("admin"),
            "team_id" => $staff->id,
            "permission" => User::PERMISSION_STAFF
        ]);
    }
}
