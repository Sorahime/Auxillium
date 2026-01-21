<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@tanggapbencana.id'],
            [
                'name' => 'Administrator',
                'email' => 'admin@tanggapbencana.id',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123456'),
                'phone' => '081234567890',
                'role' => 'admin',
            ]
        );

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@tanggapbencana.id');
        $this->command->info('Password: admin123456');
    }
}
