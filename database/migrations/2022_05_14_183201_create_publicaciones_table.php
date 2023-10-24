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
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('slug');
            $table->text('tema')->nullable();
            $table->longtext('contenido')->nullable();
            $table->enum('status', [1, 2, 3])->default(2);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *it
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publicaciones');
    }
};
