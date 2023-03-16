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
        Schema::create('user_voluntariado', function (Blueprint $table) {
            $table->bigInteger('voluntariado_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->primary(['voluntariado_id', 'user_id']);
            $table->foreign('voluntariado_id')
                ->references('id')
                ->on('voluntariados')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('user_voluntariado');
    }
};
