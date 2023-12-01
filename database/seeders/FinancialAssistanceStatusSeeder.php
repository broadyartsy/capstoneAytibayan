<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FinancialAssistanceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('financialassistancestatuses')->insert([
            //unsettled
            [
                'financial_assistance_status_name' => 'unsettled', 'description' => 'You may create a financial assistance request to the office'
            ],
            //started
            [
                'financial_assistance_status_name' => 'started', 'description' => 'Your financial assistance request has been started processing'
            ],
            //pending
            [
                'financial_assistance_status_name' => 'pending', 'description' => 'Your financial assistance request is up for approval'
            ],
            //Approved
            [
                'financial_assistance_status_name' => 'approved',
                'description' => 'Your financial assistance request has been approved'
            ],
            //disbursed
            [
                'financial_assistance_status_name' => 'disbursed',
                'description' => 'Your financial assistance has been disbursed'
            ],
            //rejected
            [
                'financial_assistance_status_name' => 'rejected',
                'description' => 'Your financial assistance request has been rejected'
            ],
        ]);
    }
}
