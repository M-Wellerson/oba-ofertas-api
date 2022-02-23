<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('descricao');
            $table->string('preco');
            $table->boolean('status')->default(1);
            $table->json('tipo_entrega')->default(new Expression('(JSON_ARRAY())'));
            $table->json('categorias')->default(new Expression('(JSON_ARRAY())'));
            $table->json('imagens')->default(new Expression('(JSON_ARRAY())'));
            $table->integer('empresa_id')->nullable()->unsigned();
            $table->timestamps();
        });

        Schema::table('produtos', function($table) {
            $table->foreign('empresa_id')->references('id')->on('empresas')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
