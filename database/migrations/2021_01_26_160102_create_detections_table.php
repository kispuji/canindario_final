<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detections', function (Blueprint $table) {
            $table->id();
            $table->integer('positives');
            $table->integer('negatives');
            $table->integer('failures')->nullable();
            $table->integer('search_time');
            $table->integer('focus_time');
            $table->string('nivel', 45)->nullable();
            $table->unsignedBigInteger('training_id');
            $table->unsignedBigInteger('sustance_id')->nullable();
            $table->foreign('training_id')
            ->references('id')
            ->on('trainings')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('sustance_id')
            ->references('id')
            ->on('sustances')
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
        Schema::dropIfExists('detections');
    }
}
