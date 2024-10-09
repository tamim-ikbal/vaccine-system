<?php

namespace Database\Seeders;

use App\Models\Registration;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Registration::factory(100)
            ->for(User::factory())
            ->create();
    }
}
