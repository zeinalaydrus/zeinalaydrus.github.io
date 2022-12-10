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
        Schema::create('pengeluaran_raw', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('raw_id');
            $table->foreign('raw_id')->references('id')->on('raw');
            $table->integer('stock');
            $table->date('tanggal_keluar');
            $table->string('bukti');
            $table->text('description');
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
        Schema::dropIfExists('pengeluaran_raw');
    }
};
