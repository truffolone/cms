<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->string('zip_code', 32);
            $table->string('telephone', 64);
            $table->string('fax', 64)->nullable();
            $table->string('email', 128);
            $table->string('url')->nullable();
            $table->integer('city_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('city_id')->references('id')->on('world_cities')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
