<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Assignment;
use App\Models\Ticket;
use App\Models\Software;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create some users
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $developer = User::create([
            'name' => 'Developer User',
            'email' => 'developer@example.com',
            'password' => bcrypt('password'),
            'role' => 'developer',
        ]);

        $client = User::create([
            'name' => 'Client User',
            'email' => 'client@example.com',
            'password' => bcrypt('password'),
            'role' => 'client',
        ]);

        // Create software
        $software1 = Software::create(['name' => 'Software A']);
        $software2 = Software::create(['name' => 'Software B']);

        // Create tickets
        $ticket1 = Ticket::create([
            'title' => 'Issue with Software A',
            'description' => 'Something is not working properly.',
            'priority' => 'High',
            'status' => 'Open',
            'user_id' => $client->id,
            'software_id' => $software1->id,
            'os' => 'Windows',
        ]);

        $ticket2 = Ticket::create([
            'title' => 'Bug in Software B',
            'description' => 'An error occurs when opening the app.',
            'priority' => 'Medium',
            'status' => 'Open',
            'user_id' => $client->id,
            'software_id' => $software2->id,
            'os' => 'Linux',
        ]);

        // Assign a ticket
        Assignment::create([
            'ticket_id' => $ticket1->id,
            'developer_id' => $developer->id,
            'admin_id' => $admin->id,
        ]);
    }
}
