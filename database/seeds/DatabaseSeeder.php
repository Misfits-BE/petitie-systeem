<?php

use Illuminate\Database\Seeder;

/**
 * General MySQL database seeder?
 * ---
 * This function basically asks for clearing the database en perform the other
 * database seeds.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $command = $this->command; // Laravel command bus.

        // Ask for db migration refresh, default is no
        if ($command->confirm('Do you wish to refresh the migration before seeding, it will clear all old data?')) {
            // Call the php artisan migrate:refresh
            $command->call('migrate:refresh');
            $command->warn('Data cleared, starting from blank database.');
        }

        // Execute other database seeders
        $this->call(UserTableSeeder::class); //! Covers also roles and permissions database table.
    }
}
