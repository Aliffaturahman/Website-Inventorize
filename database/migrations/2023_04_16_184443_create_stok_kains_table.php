<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stok_kain', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id('ID_STOK_KAIN');
            $table->unsignedBigInteger('ID_KAIN');
            $table->unsignedBigInteger('ID_PRODUKSI');
            $table->integer('TOTAL_ROLL')->default(0);
            $table->integer('TOTAL_YARD')->nullable();
            $table->timestamps();

            $table->foreign('ID_KAIN')
                ->references('ID_KAIN')->on('kain')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('ID_PRODUKSI')
                ->references('ID_PRODUKSI')->on('produksi')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    public function down()
    {
        Schema::table('stok_kain', function (Blueprint $table) {
            $table->dropForeign(['ID_KAIN']);
            $table->dropForeign(['ID_PRODUKSI']);
        });
        Schema::dropIfExists('stok_kain');
    }
};
