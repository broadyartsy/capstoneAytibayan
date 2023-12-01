<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ExistingLoanStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('currentloanstatuses')->insert([
            //not started
            [
                'current_loan_status_name' => 'not started', 'description' => 'No active loan yet.'
            ],
            //active
            [
                'current_loan_status_name' => 'active', 'description' => 'Your loan is currently active.'
            ],
            //paid
            [
                'current_loan_status_name' => 'paid', 'description' => 'You have successfully repaid the entire loan amount.'
            ],
            //overdue
            [
                'current_loan_status_name' => 'overdue', 'description' => 'You have failed to make a scheduled payment, and the loan is past its due date.'
            ],
        ]);
    }
}
