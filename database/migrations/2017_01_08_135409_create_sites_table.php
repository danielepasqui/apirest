<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('url');
            $table->string('doc_root');
            $table->string('auth_name');
            $table->string('auth_pass');
            $table->string('cms_admin');
            $table->string('cms_pass');
            $table->string('pm');
            $table->string('group');
            $table->longText('notes')->nullable();
            $table->integer('technology_id')->unsigned()->nullable();
            $table->integer('machine_id')->unsigned()->nullable();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('technology_id')->references('id')->on('technologies')->onDelete('set null');
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('set null');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
}
