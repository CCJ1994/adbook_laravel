<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateModifyTimeToUpdateAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ad_bbs', function (Blueprint $table) {
            $table->renameColumn('modify_time', 'update_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ad_bbs', function (Blueprint $table) {
            $table->renameColumn('update_at', 'modify_time');
        });
    }
}
