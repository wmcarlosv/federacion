<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('last_name',60)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->bigInteger('camera_id')->unsigned();
            $table->enum('role',['company','camara','administrador'])->default('company');
            $table->enum('partner_type',['aderente','cadete','activo'])->nullable(false);
            $table->boolean('isactive')->default(true);
            $table->bigInteger('entry_id')->unsigned();
            $table->enum('clasification',['minorista','mayorista'])->nullable(false);
            $table->boolean('isappvisible')->default(false);
            $table->string('phone',25)->nullable();
            $table->bigInteger('location_id')->unsigned();
            $table->string('direction',255)->nullable();
            $table->string('country',150)->nullable();
            $table->string('city',150)->nullable();
            $table->string('image',100)->nullable();
            $table->timestamps();

            $table->foreign('camera_id')->references('id')->on('cameras')->onUpdate('restrict')->onDelete('restrict');
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
        Schema::dropIfExists('users');
    }
}
