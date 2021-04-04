<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street', 45)->nullable();
            $table->string('number')->nullable();
            $table->string('town', 45)->nullable();
            $table->string('city', 45)->nullable();
            $table->integer('cp')->nullable();
            $table->string('country', 45)->nullable();
            $table->unsignedBigInteger('workers_id');
            $table->foreign('workers_id')
                ->references('id')
                ->on('workers')
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
        Schema::dropIfExists('addresses');
    }
}
