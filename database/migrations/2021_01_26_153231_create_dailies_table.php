<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dailies', function (Blueprint $table) {
            $table->id();
            $table->integer('duration');
            $table->integer('meters');
            $table->unsignedBigInteger('training_id');
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('training_id')
                ->references('id')
                ->on('trainings')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('type_id')
                ->references('id')
                ->on('types')
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
        Schema::dropIfExists('dailies');
    }
}
