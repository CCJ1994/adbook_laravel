<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_menus', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id('idad_meun');
            $table->integer('menu_id')->unsigned()->default(0)->comment('主選單為0／子選單為母選單的idad_menu');
            $table->integer('show')->unsigned()->default(1)->comment('顯示1不顯示0');
            $table->integer('rank')->unsigned()->comment('順序');
            $table->string('name');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_menus');
    }
}
