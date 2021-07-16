<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            [
                'name' => 'Chelsea',
            ],
            [
                'name' => 'Arsenal',
            ],
            [
                'name' => 'Manchester City',
            ],
            [
                'name' => 'Liverpool',
            ],
            [
                'name' => 'Bayern Munich',
            ],
            [
                'name' => 'Atlético Madrid',
            ]
        ]);
    }
}
