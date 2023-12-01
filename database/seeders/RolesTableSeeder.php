<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            //It Staff
            [
                'role_name' => 'itstaff'
            ],
            //Coordinator
            [
                'role_name' => 'binhiprojectcoordinator'
            ],
            [
                'role_name' => 'abakaprojectcoordinator'
            ],
            [
                'role_name' => 'agripinayprojectcoordinator'
            ],
            [
                'role_name' => 'akbayprojectcoordinator'
            ],
            [
                'role_name' => 'leadprojectcoordinator'
            ],
            //Beneficiary
            [
                'role_name' => 'beneficiary',
            ],
        ]);
    }
}
