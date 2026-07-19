<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // System Owner Admin
        $adminEmail = 'admin@hbcltd.com';
        $admin = User::where('email', $adminEmail)->first();

        if (!$admin) {
            User::forceCreate([
                'name' => 'System Admin',
                'email' => $adminEmail,
                'password' => bcrypt('password'),
                'is_system_owner' => true,
            ]);
            $this->command->info('Admin user seeded: admin@hbcltd.com / password');
        } else {
            $admin->forceFill(['is_system_owner' => true])->save();
            $this->command->info('Admin user already exists. Set as system owner.');
        }
    }
}
