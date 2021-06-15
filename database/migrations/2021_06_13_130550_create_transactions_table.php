<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('nama_transaksi');
            $table->double('jumlah_transaksi');
            $table->enum('jenis_transaksi', ['pengeluaran', 'pemasukan']);
            $table->date('tanggal_transaksi')->default(now());
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
