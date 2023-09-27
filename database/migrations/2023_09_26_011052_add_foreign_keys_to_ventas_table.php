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
        Schema::table('ventas', function (Blueprint $table) {
            $table->foreign(['id_factura'], 'ventas_ibfk_2')->references(['id_factura'])->on('facturas');
            $table->foreign(['id_producto'], 'ventas_ibfk_1')->references(['id_producto'])->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropForeign('ventas_ibfk_2');
            $table->dropForeign('ventas_ibfk_1');
        });
    }
};
