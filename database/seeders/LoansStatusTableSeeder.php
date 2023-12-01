<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoansStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('loanstatuses')->insert([
            //unsettled
            [
                'loan_status_name' => 'unsettled', 'description' => 'You may create a loan request to the office'
            ],
            //started
            [
                'loan_status_name' => 'started', 'description' => 'Your loan request has been started processing'
            ],
            //pending
            [
                'loan_status_name' => 'pending', 'description' => 'Your loan application is submitted and awaiting approval.'
            ],
            //Approved
            [
                'loan_status_name' => 'approved',
                'description' => 'Your loan application has been approved, you can proceed with the loan.'
            ],
            //disbursed
            [
                'loan_status_name' => 'disbursed',
                'description' => 'Your loan request has been disbursed'
            ],
            //rejected
            [
                'loan_status_name' => 'rejected',
                'description' => 'Your loan request has been rejected'
            ],
        ]);
    }
}
