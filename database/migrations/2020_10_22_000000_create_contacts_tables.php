<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('external_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('office_phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('job_title')->nullable();
            $table->string('department')->nullable();
            $table->foreignId('clients_id');

            $table->text('primary_address')->nullable();
            $table->string('primary_address_city')->nullable();
            $table->string('primary_address_state')->nullable();
            $table->string('primary_address_postcode')->nullable();
            $table->string('primary_address_country')->nullable();

            $table->text('other_address')->nullable();
            $table->string('other_address_city')->nullable();
            $table->string('other_address_state')->nullable();
            $table->string('other_address_postcode')->nullable();
            $table->string('other_address_country')->nullable();

            $table->text('description');
            $table->integer('user_id')->unsigned()->nullable();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('client_id')->references('id')->on('clients')->cascadeOnDelete();

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
        Schema::dropIfExists('contacts');
    }
}
