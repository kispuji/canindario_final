<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('zone', 45)->nullable();
            $table->time('time')->nullable();
            $table->integer('series');
            $table->text('criterion')->nullable();
            $table->unsignedBigInteger('technique_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('worker_id')->nullable();
            $table->unsignedBigInteger('dog_id');
            $table->foreign('technique_id')
            ->on('techniques')
            ->references('id')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('user_id')
            ->on('users')
            ->references('id')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('worker_id')
            ->references('id')
            ->on('workers')
            ->onDelete('set null')
            ->onUpdate('cascade');
        $table->foreign('dog_id')
            ->references('id')
            ->on('dogs')
            ->onDelete('cascade')
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
        Schema::dropIfExists('trainings');
    }
}
