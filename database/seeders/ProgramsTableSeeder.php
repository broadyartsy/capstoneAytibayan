<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('programs')->insert([
            //Binhi
            [
                // 'project_coordinator_id' => '1',
                'program_name' => 'binhingpagasa',
                'email' => 'projectcoordinator@gmail.com'
            ],
            //Akbay
            [
                // 'project_coordinator_id' => '3',
                'program_name' => 'akbay',
                'email' => 'akbayprojectcoordinator@gmail.com'
            ],
            //Lead
            [
                // 'project_coordinator_id' => '5',
                'program_name' => 'lead',
                'email' => 'leadprojectcoordinator@gmail.com'
            ],
            //AgriPinay
            [
                // 'project_coordinator_id' => '9',
                'program_name' => 'agripinay',
                'email' => 'agripinayprojectcoordinator@gmail.com'
            ],
            //Abaka
            [
                // 'project_coordinator_id' => '11',
                'program_name' => 'abakamopisomo',
                'email' => 'diverlynsy@gmail.com'
            ],
        ]);
    }
}
