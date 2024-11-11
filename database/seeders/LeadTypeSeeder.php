<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeadTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crm_lead_types')->delete();

        $now = Carbon::now();

        DB::table('crm_lead_types')->insert([
            [
                'id'         => 1,
                'name'       => 'New Business',
                'created_at' => $now,
                'updated_at' => $now,
            ], [
                'id'         => 2,
                'name'       => 'Existing Business',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
