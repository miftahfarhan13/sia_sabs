<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_siswa extends Model
{
    protected $table = 'siswas';
    protected $fillable = [
        'id_user',
        'id_orangtua',
        'nama_siswa',
        'tanggal_lahir',
        'alamat',
        'jenis_kelamin',
        'created_at',
        'updated_at',
    ];
}
