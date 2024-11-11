<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobLookupIdToContractorAndAssessorJoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contractor_property', function ($table) {
            $table->bigInteger('job_id')->nullable()->default(0);
        });

        Schema::table('assessor_property', function ($table) {
            $table->bigInteger('job_id')->nullable()->default(0);
        });

        DB::statement("UPDATE assessor_property SET job_id = (SELECT id FROM job_lookups WHERE job_lookups.title = assessor_property.job AND job_lookups.type='assessor_job' LIMIT 1);");

        DB::statement("UPDATE contractor_property SET job_id = (SELECT id FROM job_lookups WHERE job_lookups.title = contractor_property.job AND job_lookups.type='contractor_job' LIMIT 1);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contractor_property', function ($table) {
            $table->dropColumn('job_id');
        });

        Schema::table('assessor_property', function ($table) {
            $table->dropColumn('job_id');
        });
    }
}
