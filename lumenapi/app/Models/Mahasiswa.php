<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Mahasiswa extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

     protected $primaryKey = 'nim';
     public $timestamps = false; //Untuk menghilangkan record yang dibuat secara default
     public $incrementing = false; //Untuk memunculkan nim yang sesuai pada response 

    protected $fillable = [
        'nim', 
        'nama',
        'prodi_Id',
        'angkatan', 
        'password',
        'token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_Id');
    }
}
