<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_titles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('response');
            $table->foreignId('result_id')->references('id')->on('results')->onDelete('cascade');
            $table->boolean('estatus')->default(1);
            $table->foreignId('eps_id')->references('id')->on('eps')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('update_user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('result_titles');
    }
};
