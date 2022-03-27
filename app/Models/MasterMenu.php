<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterMenu extends Model
{
    protected $table        = 'master_menu';

    protected $fillable     = [
        'nama_menu',
        'satuan',
        'harga',
        'status',
        'kategori',
        'foto',
    ];

    protected $primaryKey   = 'id_menu';
}
