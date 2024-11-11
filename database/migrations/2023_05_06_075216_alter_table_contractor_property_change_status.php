<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableContractorPropertyChangeStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // User raw query because don't wanna install doctrine/dbal
        DB::statement("ALTER TABLE `contractor_property` CHANGE `status` `status` VARCHAR(50) NULL DEFAULT 'Pending';");         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // User raw query because don't wanna install doctrine/dbal
        DB::statement("ALTER TABLE `contractor_property` CHANGE `status` `status` enum('Pending','Accepted','Rejected','Complete','Variation','In-Progress') NULL DEFAULT 'Pending';");
    }
}
