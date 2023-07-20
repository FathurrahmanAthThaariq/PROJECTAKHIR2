<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Setting::create([
            'site_name' => 'Laravel 8',
            'site_logo' => 'logo.png',
            'site_favicon' => 'favicon.png',
            'site_email' => 'admin@vpnstores.my.id',
        ]);

        $this->call([
            RoleSeeder::class,
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $admin->assignRole('admin');

        $manager = User::create([
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $manager->assignRole('manager');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('user');
    }
}
