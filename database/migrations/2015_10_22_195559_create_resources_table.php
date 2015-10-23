<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('resources', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('title')->unique();
		    $table->string('description');
		    $table->string('link')->unique();
		    $table->integer('user_id')->unsigned();
		    $table->integer('cat_id')->unsigned();
		    $table->timestamps();

		    $table->foreign('user_id')
			    ->references('id')
			    ->on('users');

		    $table->foreign('cat_id')
			    ->references('id')
			    ->on('categories');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::drop('resources');
    }
}
