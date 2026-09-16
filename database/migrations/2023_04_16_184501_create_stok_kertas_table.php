<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stok_kertas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id('ID_STOK_KERTAS');
            $table->unsignedBigInteger('ID_BERAT');
            $table->unsignedBigInteger('ID_KERTAS');
            $table->integer('LEBAR')->nullable(false);
            $table->integer('PANJANG')->nullable(false);
            $table->integer('JUMLAH_KERTAS')->nullable(false);
            $table->timestamps();

            $table->foreign('ID_BERAT')
                ->references('ID_BERAT')->on('berat')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('ID_KERTAS')
                ->references('ID_KERTAS')->on('kertas')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    public function down()
    {
        Schema::table('stok_kertas', function (Blueprint $table) {
            $table->dropForeign(['ID_BERAT']);
            $table->dropForeign(['ID_KERTAS']);
        });

        Schema::dropIfExists('stok_kertas');
    }
};
