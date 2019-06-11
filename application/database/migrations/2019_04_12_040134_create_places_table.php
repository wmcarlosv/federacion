<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100)->nullable(false);
            $table->boolean('isactive')->default(true);
            $table->bigInteger('entry_id')->unsigned();
            $table->string('phone',25)->nullable();
            $table->bigInteger('location_id')->unsigned();
            $table->string('direction',255)->nullable();
            $table->string('country',150)->nullable();
            $table->string('city',150)->nullable();
            $table->string('image',100)->nullable();
            $table->string('description',255)->nullable();
            $table->timestamps();

            $table->foreign('entry_id')->references('id')->on('entries')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('location_id')->references('id')->on('locations')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
