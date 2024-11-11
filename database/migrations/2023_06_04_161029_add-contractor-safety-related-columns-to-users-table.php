<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContractorSafetyRelatedColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('contractor_next_of_kin_name', 255)->nullable()->default(null);
            $table->string('contractor_safe_pass_photo', 255)->nullable()->default(null);
            $table->string('contractor_next_of_kin_phone', 15)->nullable()->default(null);
            $table->date('contractor_safe_pass_expiry')->nullable()->nullable()->default(null);
            $table->text('contractor_medical_issue')->nullable()->default(null);
            $table->tinyInteger('contractor_agree_to_health_and_safety_procedure')->nullable()->default(0);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('contractor_next_of_kin_name');
            $table->dropColumn('contractor_safe_pass_photo');
            $table->dropColumn('contractor_next_of_kin_phone');
            $table->dropColumn('contractor_safe_pass_expiry');
            $table->dropColumn('contractor_medical_issue');
            $table->dropColumn('contractor_agree_to_health_and_safety_procedure');
        });
    }
}
