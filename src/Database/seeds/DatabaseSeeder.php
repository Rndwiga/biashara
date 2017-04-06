<?php

namespace Tyondo\Biashara\Database\seeds;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call('Tyondo\Biashara\Database\seeds\BiasharaTableSeeder');

    }
}
