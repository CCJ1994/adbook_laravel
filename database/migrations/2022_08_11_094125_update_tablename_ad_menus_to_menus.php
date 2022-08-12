<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTablenameAdMenusToMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ad_menus', function (Blueprint $table) {
            Schema::rename('ad_menus', 'menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ad_menus', function (Blueprint $table) {
            Schema::rename('menus', 'ad_menus');
        });
    }
}
