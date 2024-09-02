<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create test data for employees
        \App\Models\Employee::factory(10)->create();

        \App\Models\Employee::factory()->create([
        ]);


    }
}
