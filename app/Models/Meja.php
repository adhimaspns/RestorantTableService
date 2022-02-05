<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table        = 'meja';

    protected $fillable     = [
        'nama_meja',
        'deskripsi',
        'jenis_meja',
        'kapasitas',
        'satuan',
        'foto',
        'harga',
        'status'
    ];

    protected $primaryKey   = 'id_meja';

    //! Relationship
    
    //* Booking
    public function booking()
    {
        return $this->hasMany(Booking::class, 'mejaID', 'id_meja');
    } 
}
