<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObediencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obediences', function (Blueprint $table) {
            $table->id();
            $table->integer('duration');
            $table->integer('positives');
            $table->integer('negatives');
            $table->integer('failures')->nullable();
            $table->unsignedBigInteger('training_id');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('training_id')
                ->references('id')
                ->on('trainings')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
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
        Schema::dropIfExists('obediences');
    }
}
