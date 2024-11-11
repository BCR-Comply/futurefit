<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateContractorPropertyMakeSurveyorIdNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `contractor_property` CHANGE `surveyor_id` `surveyor_id` INT NULL;");         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `contractor_property` CHANGE `surveyor_id` `surveyor_id` INT NOT NULL;");      
    }
}
