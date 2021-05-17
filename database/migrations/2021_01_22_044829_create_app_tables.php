<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('sort_no');
            $table->timestamps();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('review');
            $table->integer('sort_no');
            $table->timestamps();
        });

        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('category_id');
            $table->string('name')->unique();
            $table->text('description');
            $table->text('content');
            $table->unsignedInteger('price');
            $table->string('state');
            $table->double('avg_rate')->default(0);
            $table->integer('count_rate')->default(0);
            $table->timestamps();
    
            $table->foreign('seller_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idea_id');
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->text('description');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('buyer_id');
            $table->integer('rates')->default(null)->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('idea_id')->references('id')->on('ideas')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('seller_id')->references('seller_id')->on('ideas')->onDelete('cascade');
            $table->foreign('buyer_id')->references('id')->on('users');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trades');
        Schema::dropIfExists('ideas');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('categories');
    }
}