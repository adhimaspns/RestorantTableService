<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table        = 'booking';

    protected $fillable     = [
        'no_transaksi',
        'customerID',
        'mejaID',
        'jam_awal',
        'jam_akhir',
        'status',
        'grandtotal',
        'bukti_transfer'
    ];

    protected $primaryKey   = 'id_booking';

    //! Relationship 

    //* User 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //* Meja
    public function meja()
    {
        return $this->belongsTo(Meja::class, 'mejaID', 'id_meja');
    } 
}
