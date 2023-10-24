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
        Schema::create('publiguardadas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('publicaciones_id');
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('publicaciones_id')->references('id')->on('publicaciones')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');  
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
        Schema::dropIfExists('publiguardadas');
    }
};
