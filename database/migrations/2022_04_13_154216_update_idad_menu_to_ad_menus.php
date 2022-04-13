<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateIdadMenuToAdMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ad_menus', function (Blueprint $table) {
            $table->renameColumn('idad_meun','idad_menu');
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
            $table->renameColumn('idad_menu','idad_meun');

        });
    }
}
