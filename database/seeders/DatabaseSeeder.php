<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::createAdmin('Juan Sánchez', 'jsanchez.gr@gmail.com', 'peperoni');
        \App\Models\Artist::factory(50)->create();
        \App\Models\Event::factory(125)->create();
    }
}
