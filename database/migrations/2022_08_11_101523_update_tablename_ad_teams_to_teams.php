<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTablenameAdTeamsToTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ad_teams', function (Blueprint $table) {
            Schema::rename('ad_teams', 'teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ad_teams', function (Blueprint $table) {
            Schema::rename('teams', 'ad_teams');
        });
    }
}
