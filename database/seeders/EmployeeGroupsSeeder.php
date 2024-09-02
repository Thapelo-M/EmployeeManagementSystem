<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeGroupsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\EmployeeGroup::factory()->create([
        //     'group_name' => 'Technical'
        // ]);
        // \App\Models\EmployeeGroup::factory()->create([
        //     'group_name' => 'Manager'
        // ]);
        // \App\Models\EmployeeGroup::factory()->create([
        //     'group_name' => 'Admin'
        // ]);
        // \App\Models\EmployeeGroup::factory()->create([
        //     'group_name' => 'Clerk'
        // ]);
        // \App\Models\EmployeeGroup::factory()->create([
        //     'group_name' => 'GM'
        // ]);
        // \App\Models\EmployeeGroup::factory()->create([
        //     'group_name' => 'Graduate'
        // ]);
        // \App\Models\EmployeeGroup::factory()->create([
        //     'group_name' => 'CTIO'
        // ]);
        // \App\Models\Employee::factory(10)->create();

        \App\Models\EmployeeGroup::factory(10)->create();
    }
}
