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
        Schema::create('tinta', function (Blueprint $table) {
            $table->id('ID_TINTA');
            $table->unsignedBigInteger('ID_VOLUME');
            $table->unsignedBigInteger('ID_WARNA');
            $table->integer('JUMLAH_TINTA')->notNullable();
            $table->timestamps();

            $table->foreign('ID_VOLUME')
                ->references('ID_VOLUME')->on('volume')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('ID_WARNA')
                ->references('ID_WARNA')->on('warna')
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
        Schema::table('tinta', function (Blueprint $table) {
            $table->dropForeign(['ID_VOLUME']);
            $table->dropForeign(['ID_WARNA']);
        });

        Schema::dropIfExists('tinta');
    }
};
