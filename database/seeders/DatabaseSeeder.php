<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Seeders\UsersTableSeeder;
use Database\Seeders\CategoriesTableSeeder;
use Database\Seeders\TicketsTableSeeder;
use Database\Seeders\TicketDetailsTableSeeder;
use Database\Seeders\DocumentsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\EmployeesTableSeeder;
use Database\Seeders\ItemsTableSeeder;
use Database\Seeders\IncidentsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            TicketsTableSeeder::class,
            TicketDetailsTableSeeder::class,
            DocumentsTableSeeder::class,
            EmployeesTableSeeder::class,
            ItemsTableSeeder::class,
            IncidentsTableSeeder::class,
        ]);
    }
}
