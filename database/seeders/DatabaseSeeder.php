<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PosClient;
use App\Models\PosBook;
use App\Models\PosOrder;
use App\Models\PosOrderDetail;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        PosClient::factory(10)->create();

        PosBook::factory(8)->create();

    }
}
