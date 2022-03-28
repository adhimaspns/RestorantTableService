<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table        = 'detail_menu';

    protected $fillable     = [
        'no_transaksi',
        'menu',
        'kategori',
        'jml',
        'harga',
        'subtotal'
    ];

    protected $primaryKey   = 'id_dtl_menu';
}
