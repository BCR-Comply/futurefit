<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdColumnInTblUsersTable extends Migration
{
    public function up()
    {
        Schema::table('tbl_user', function (Blueprint $table) {
            $table->integer('contractor_id')->nullable();
            $table->integer('assessor_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_user', function (Blueprint $table) {
            $table->dropColumn('contractor_id');
            $table->dropColumn('assessor_id');
        });
    }
}
