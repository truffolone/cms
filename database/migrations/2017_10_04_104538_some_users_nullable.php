<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SomeUsersNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('question')->nullable()->change();
            $table->string('answer')->nullable()->change();
            $table->unsignedInteger('country_id')->nullable()->change();
            $table->unsignedInteger('city_id')->nullable()->change();
        });

        Schema::table('user_infos', function (Blueprint $table) {
            $table->string('address')->nullable()->change();
            $table->string('zip_code', 32)->nullable()->change();
            $table->string('piva', 64)->nullable()->change();
            $table->text('more_info')->nullable()->change();
            $table->string('telephone', 128)->nullable()->change();
            $table->string('cellphone', 128)->nullable()->change();
            $table->string('fax', 128)->nullable()->change();
            $table->string('first_name', 128)->nullable()->change();
            $table->string('middle_name', 128)->nullable()->change();
            $table->string('last_name', 128)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('question')->change();
            $table->string('answer')>change();
            $table->unsignedInteger('country_id')->change();
            $table->unsignedInteger('city_id')->change();
        });

        Schema::table('user_infos', function (Blueprint $table) {
            $table->string('address')->change();
            $table->string('zip_code', 32)->change();
            $table->string('piva', 64)->change();
            $table->text('more_info')->change();
            $table->string('telephone', 128)->change();
            $table->string('cellphone', 128)->change();
            $table->string('fax', 128)->change();
            $table->string('first_name', 128)->change();
            $table->string('middle_name', 128)->change();
            $table->string('last_name', 128)->change();
        });
    }
}
