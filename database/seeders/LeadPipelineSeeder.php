<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeadPipelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crm_lead_pipelines')->delete();

        DB::table('crm_lead_pipeline_stages')->delete();

        $now = Carbon::now();

        DB::table('crm_lead_pipelines')->insert([
            [
                'id'         => 1,
                'name'       => 'Default Pipeline',
                'is_default' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);

        DB::table('crm_lead_pipeline_stages')->insert([
            [
                'id'               => 1,
                'code'             => 'new',
                'name'             => 'New Lead',
                'probability'      => 100,
                'sort_order'       => 1,
                'lead_pipeline_id' => 1,
            ], [
                'id'               => 2,
                'code'             => 'follow-up',
                'name'             => 'To Follow Calls',
                'probability'      => 100,
                'sort_order'       => 2,
                'lead_pipeline_id' => 1,
            ], [
                'id'               => 3,
                'code'             => 'prospect',
                'name'             => 'Willies Calls',
                'probability'      => 100,
                'sort_order'       => 3,
                'lead_pipeline_id' => 1,
            ], [
                'id'               => 4,
                'code'             => 'negotiation',
                'name'             => 'Booked Appointments',
                'probability'      => 100,
                'sort_order'       => 4,
                'lead_pipeline_id' => 1,
            ], [
                'id'               => 5,
                'code'             => 'won',
                'name'             => 'Not Interested',
                'probability'      => 100,
                'sort_order'       => 5,
                'lead_pipeline_id' => 1,
            ], [
                'id'               => 6,
                'code'             => 'lost',
                'name'             => 'WCU',
                'probability'      => 0,
                'sort_order'       => 6,
                'lead_pipeline_id' => 1,
            ]
        ]);
    }
}
