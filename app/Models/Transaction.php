<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['nama_transaksi', 'jumlah_transaksi', 'jenis_transaksi', 'tanggal_transaksi'];
}
