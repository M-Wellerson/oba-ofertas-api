<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empresas_id');
            $table->foreign('empresas_id')->references('id')->on('empresas')->onDelete('restrict');
            $table->string('descricao', 255);
            $table->string('regulamento', 255);
            $table->string('desconto', 100);
            $table->string('quantidade', 100);
            $table->json('periodo')->default(new Expression('(JSON_ARRAY())'));
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('cupons');
    }
}
