<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crm_attribute_options')->delete();

        $now = Carbon::now();

        DB::table('crm_attribute_options')->insert([
            [
                'id'             => 1,
                'name'           => 'Lead',
                'sort_order'     => 1,
                'attribute_id'   => 44
            ], [
                'id'             => 2,
                'name'           => 'TF Call',
                'sort_order'     => 2,
                'attribute_id'   => 44
            ], [
                'id'             => 3,
                'name'           => 'Willies Call',
                'sort_order'     => 3,
                'attribute_id'   => 44
            ], [
                'id'             => 4,
                'name'           => 'Booked Appts',
                'sort_order'     => 4,
                'attribute_id'   => 44
            ], [
                'id'             => 5,
                'name'           => 'Not Interested',
                'sort_order'     => 5,
                'attribute_id'   => 44
            ], [
                'id'             => 6,
                'name'           => 'WCU',
                'sort_order'     => 6,
                'attribute_id'   => 44
            ]
        ]);
    }
}