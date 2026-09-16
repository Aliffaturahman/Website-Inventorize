<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name'     => 'Administrator',
            'email'    => 'admin@gmail.com',
            'role'    => 'admin',
            'password' => bcrypt('admin123'),
        ]);

        // Admin::create([
        //     'name'     => 'Editor',
        //     'email'    => 'editor@localhost.com',
        //     'role'    => 'editor',
        //     'password' => bcrypt('editor123'),
        // ]);

        Admin::create([
            'name'     => 'Operator',
            'email'    => 'operator@gmail.com',
            'role'    => 'operator',
            'password' => bcrypt('operator321'),
        ]);
    }
}
