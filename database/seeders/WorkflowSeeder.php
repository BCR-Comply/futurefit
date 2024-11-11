<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crm_workflows')->delete();

        $now = Carbon::now();

        DB::table('crm_workflows')->insert([
            [
                'id'             => 1,
                'name'           => 'Emails to participants after activity creation',
                'description'    => 'Emails to participants after activity creation',
                'entity_type'    => 'activities',
                'event'          => 'activity.create.after',
                'condition_type' => 'and',
                'conditions'     => '[{"value": ["call", "meeting", "lunch"], "operator": "{}", "attribute": "type", "attribute_type": "multiselect"}]',
                'actions'        => '[{"id": "send_email_to_participants", "value": "1"}]',
                'created_at'     => $now,
                'updated_at'     => $now,
            ], [
                'id'             => 2,
                'name'           => 'Emails to participants after activity updation',
                'description'    => 'Emails to participants after activity updation',
                'entity_type'    => 'activities',
                'event'          => 'activity.update.after',
                'condition_type' => 'and',
                'conditions'     => '[{"value": ["call", "meeting", "lunch"], "operator": "{}", "attribute": "type", "attribute_type": "multiselect"}]',
                'actions'        => '[{"id": "send_email_to_participants", "value": "2"}]',
                'created_at'     => $now,
                'updated_at'     => $now,
            ]
        ]);
    }
}
