<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeadSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crm_lead_sources')->delete();

        $now = Carbon::now();

        DB::table('crm_lead_sources')->insert([
            [
                'id'         => 1,
                'name'       => 'Email',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
