<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFliedsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('userid');
            $table->integer('status')->unsigned()->default(1)->comment('停用0');
            $table->string('role')->default(NULL);
            $table->string('team')->default(NULL);
            $table->string('modify_by')->default(NULL);
            $table->datetime('modify_time')->default(date("Y-m-d H:i:s"));
            $table->string('sign1')->default('N');
            $table->string('sign2')->default('N');
            $table->string('team_view')->default('N');
            $table->string('utma')->default(NULL);
            $table->string('tel')->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('userid');
            $table->dropColumn('status');
            $table->dropColumn('role');
            $table->dropColumn('team');
            $table->dropColumn('modify_by');
            $table->dropColumn('modify_time');
            $table->dropColumn('sign1');
            $table->dropColumn('sign2');
            $table->dropColumn('team_view');
            $table->dropColumn('utma');
            $table->dropColumn('tel');
        });
    }
}
