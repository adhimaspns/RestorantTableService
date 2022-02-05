<?php

namespace App;

use App\Models\Booking;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'alamat', 
        'jns_kelamin',
        'no_telp',
        'username',
        'password',
        'status',
        'level',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    protected $primaryKey = 'id_user';

    //! Relationship

    //* Booking
    public function booking()
    {
        return $this->hasMany(Booking::class);
    } 
}
