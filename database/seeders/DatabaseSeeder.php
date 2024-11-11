<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\LeadTypeSeeder;
use Database\Seeders\WorkflowSeeder;
use Database\Seeders\AttributeSeeder;
use Database\Seeders\LeadSourceSeeder;
use Database\Seeders\LeadPipelineSeeder;
use Database\Seeders\EmailTemplateSeeder;
use Database\Seeders\AttributeOptionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AttributeSeeder::class);
        $this->call(EmailTemplateSeeder::class);
        $this->call(LeadPipelineSeeder::class);
        $this->call(LeadTypeSeeder::class);
        $this->call(LeadSourceSeeder::class);
        $this->call(WorkflowSeeder::class);
        $this->call(AttributeOptionSeeder::class);
    }
}
