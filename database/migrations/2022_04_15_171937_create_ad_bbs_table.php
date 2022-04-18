<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdBbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_bbs', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id('idad_bb');
            $table->string('topic')->comment('主題');
            $table->text('content')->comment('內容');
            $table->date('msg_date');
            $table->string('modify_by');
            $table->datetime('modify_time');
            $table->integer('status')->unsigned()->default(1)->comment('顯示1不顯示0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_bbs');
    }
}
