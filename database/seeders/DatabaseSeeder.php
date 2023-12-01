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
        // Seed roles table first
        $this->call([
            RolesTableSeeder::class,
        ]);

        // Seed programs table
        $this->call([
            ProgramsTableSeeder::class,
        ]);

        // Seed sstuses table
        $this->call([
            StatusesTableSeeder::class,
        ]);

        // Seed financial assistance statuses table
        $this->call([
            FinancialAssistanceStatusSeeder::class,
        ]);

        // Seed loan statuses table
        $this->call([
            LoansStatusTableSeeder::class,
        ]);

        // Seed current loan statuses table
        $this->call([
            ExistingLoanStatusTableSeeder::class,
        ]);

        // seed users table 
        $this->call(UsersTableSeeder::class);
        \App\Models\User::factory(40)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
