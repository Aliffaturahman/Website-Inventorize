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
        Schema::create('roll', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id('ID_ROLL');
            $table->unsignedBigInteger('ID_STOK_KAIN');
            $table->integer('YARD')->unsigned();
            $table->timestamps();

            $table->foreign('ID_STOK_KAIN')
                ->references('ID_STOK_KAIN')->on('stok_kain')
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
        Schema::table('roll', function (Blueprint $table) {
            $table->dropForeign(['ID_STOK_KAIN']);
        });

        Schema::dropIfExists('roll');
    }
};
