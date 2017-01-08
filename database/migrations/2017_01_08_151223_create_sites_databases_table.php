<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesDatabasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites_databases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sid')->unsigned()->nullable();
            $table->foreign('sid')->references('sid')
            ->on('sites')->onDelete('cascade');

            $table->integer('did')->unsigned()->nullable();
      	    $table->foreign('did')->references('did')
            ->on('databases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites_databases');
    }
}
