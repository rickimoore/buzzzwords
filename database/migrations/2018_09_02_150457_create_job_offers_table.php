<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('link');
            $table->text('description')->nullable();
            $table->string('title')->nullable();
            $table->string('company')->nullable();
            $table->text('keywords');
            $table->string('site')->nullable();
            $table->string('location')->nullable();
            $table->integer('views')->default(0);
            $table->enum('completion', ['yes', 'no'])->default('no');
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
        Schema::dropIfExists('job_offers');
    }
}
