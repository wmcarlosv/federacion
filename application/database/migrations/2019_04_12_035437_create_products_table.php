<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',60)->nullable(false);
            $table->float('price')->nullable(false);
            $table->string('cover',100)->nullable();
            $table->bigInteger('entry_id')->unsigned();
            $table->string('description',255)->nullable();
            $table->string('phone',25)->nullable();
            $table->string('whatsapp',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('direction',255)->nullable();
            $table->text('content')->nullable();
            $table->timestamps();

            $table->foreign('entry_id')->references('id')->on('entries')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
