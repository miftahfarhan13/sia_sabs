<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = [
        'kode_kelas',
        'nama_kelas',
    ];
}
