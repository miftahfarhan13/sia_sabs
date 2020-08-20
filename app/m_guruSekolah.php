<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_guruSekolah extends Model
{
    protected $table = 'guru_sekolahs';
    protected $fillable = [
        'id_user',
        'id_mata_pelajaran',
        'nama_guru_sekolah',
        'tanggal_lahir',
        'alamat',
        'jenis_kelamin',
    ];
}
