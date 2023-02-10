<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('verifier_id');
            $table->boolean('approved');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('verifier_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adverts');
    }
};
