<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class RecipientUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Recipient User',
            'email' => 'recipient@app.com',
            'password' => bcrypt('password'),
            'whatsapp_number' => env('RECIPIENT_WHATSAPP_NUMBER'),
        ]);
    }
}
