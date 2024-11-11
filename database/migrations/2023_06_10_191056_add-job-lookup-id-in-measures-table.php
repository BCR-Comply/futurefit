<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobLookupIdInMeasuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('measures', function ($table) {
            $table->bigInteger('job_id')->nullable()->default(0);
        });

        DB::statement("UPDATE measures SET job_id = (SELECT id FROM job_lookups WHERE job_lookups.title = measures.measure AND job_lookups.type='contractor_job' LIMIT 1);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('measures', function ($table) {
            $table->dropColumn('job_id');
        });
    }
}
