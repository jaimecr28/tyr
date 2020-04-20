<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('is_parent')->default("0");
            $table->string('cnpj')->nullable();
            $table->mediumText('adress')->nullable();
            $table->string('adress_number')->nullable();
            $table->string('adress_complement')->nullable();
            $table->string('adress_cep')->nullable();
            $table->string('adress_uf',10)->nullable();
            $table->string('adress_city')->nullable();
            $table->string('adress_district')->nullable();
            $table->integer('phone')->nullable();
            $table->timestamps();
           // $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enterprises');
    }
}
