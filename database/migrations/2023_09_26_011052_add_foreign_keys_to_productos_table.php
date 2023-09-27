<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->foreign(['id_proveedor'], 'productos_ibfk_2')->references(['id_proveedor'])->on('proveedores');
            $table->foreign(['id_categoria'], 'productos_ibfk_1')->references(['id_categoria'])->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropForeign('productos_ibfk_2');
            $table->dropForeign('productos_ibfk_1');
        });
    }
};
