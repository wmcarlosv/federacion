<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_from')->unsigned();
            $table->bigInteger('user_to')->unsigned();
            $table->string('subject',250)->nullable(false);
            $table->text('message')->nullable(false);
            $table->timestamps();

            $table->foreign('user_from')->references('id')->on('users')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('user_to')->references('id')->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
