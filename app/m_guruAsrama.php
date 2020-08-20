<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_guruAsrama extends Model
{
    protected $table = 'guru_asramas';
    protected $fillable = [
        'nik_guruasrama',
        'nama_guru_asrama',
        'tanggal_lahir',
        'alamat',
        'jenis_kelamin',
    ];
}
