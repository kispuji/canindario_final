<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dogs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->integer('age')->nullable();
            $table->string('specialty', 45)->nullable();
            $table->string('race', 45)->nullable();
            $table->string('marking', 20)->nullable();
            $table->string('microchip', 45)->nullable();
            $table->integer('amount_food')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('worker_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('worker_id')
                ->references('id')
                ->on('workers')
                ->onDelete('set null')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('dogs');
    }
}
