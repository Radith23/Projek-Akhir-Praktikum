<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table = 'matakuliahs';

    protected $fillable = [
        'nama',
        'token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [];

    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_matakuliah', 'mkId', 'mhsNim');
    }
}