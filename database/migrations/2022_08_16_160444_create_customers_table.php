<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact');
            $table->string('email');
            $table->string('phone');
            $table->string('fax');
            $table->string('addr');
            $table->integer('type')->comment('1.廣告主2.代理商');
            $table->string('customer')->nullable()->comment('如果是廣告代理商,它的廣告主');
            $table->string('ein')->comment('統一編號');
            $table->string('udn')->default('N')->comment('udn內部單位');
            $table->string('memo')->nullable()->comment('備註');
            $table->integer('class')->comment('產業別');
            $table->integer('status')->default(1)->comment('udn內部單位');
            $table->string('finance_cust_id')->nullable()->comment('財會代號');
            $table->dateTime('finance_upd_time')->nullable()->comment('和財會最後更新時間');
            $table->string('modify_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
