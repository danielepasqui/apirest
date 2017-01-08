<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('sid');
            $table->string('nome');
            $table->string('url');
            $table->string('doc_root');
            $table->string('auth_name');
            $table->string('auth_pass');
            $table->string('cms_admin');
            $table->string('cms_pass');
            $table->string('pm');
            $table->string('group');
            $table->longText('notes')->nullable();
            $table->integer('tid')->unsigned();
            $table->integer('mid')->unsigned();
            $table->integer('cid')->unsigned();
            $table->foreign('tid')->references('tid')->on('technologies');
            $table->foreign('mid')->references('mid')->on('machines');
            $table->foreign('cid')->references('cid')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
}
