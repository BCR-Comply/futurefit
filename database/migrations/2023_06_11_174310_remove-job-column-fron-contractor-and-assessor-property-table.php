<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveJobColumnFronContractorAndAssessorPropertyTable extends Migration
{
    public function up()
    {
        Schema::table('contractor_property', function ($table) {
            $table->dropColumn('job');
        });

        Schema::table('assessor_property', function ($table) {
            $table->dropColumn('job');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contractor_property', function ($table) {
            $table->string('job')->nullable()->default('');
        });

        Schema::table('assessor_property', function ($table) {
            $table->string('job')->nullable()->default('');
        });
    }
}
