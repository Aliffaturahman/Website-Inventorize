<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id('ID_TRANSAKSI');
            $table->unsignedBigInteger('ID_STOK_KERTAS');
            $table->integer('JUMLAH_KERTAS');
            $table->unsignedBigInteger('ID_STOK_KAIN');
            $table->integer('JUMLAH_KAIN');
            $table->date('TGL')->default(DB::raw('current_date()'));
            $table->string('KETERANGAN', 1024);
            $table->timestamps();

            $table->foreign('ID_STOK_KAIN')
                ->references('ID_STOK_KAIN')->on('stok_kain')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('ID_STOK_KERTAS')
                ->references('ID_STOK_KERTAS')->on('stok_kertas')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropForeign(['ID_STOK_KERTAS']);
            $table->dropForeign(['ID_STOK_KAIN']);
        });
        Schema::dropIfExists('transaksi');
    }
};
