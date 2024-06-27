<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendedor_id');
            $table->float('valor_total',8,2);
            $table->float('comissao',8,2);
            $table->date('data_venda');
            $table->timestamps();
            $table->foreign('vendedor_id')->references('id')->on('vendas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendas', function(Blueprint $table)
        {
            $table->dropForeign('vendas_vendedor_id_foreign');
            $table->dropIfExists('vendas');
        });
        
    }
}
