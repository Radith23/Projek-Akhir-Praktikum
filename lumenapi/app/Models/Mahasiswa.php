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
        'matakuliahId',
        'prodiId',
        'angkatan', 
        'password',
        
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password', 'token'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodiId');
    }

    public function matakuliah()
    {
        return $this->belongsToMany(MataKuliah::class, 'mahasiswa_matakuliah', 'mhsNim', 'mkId');
    }
}
