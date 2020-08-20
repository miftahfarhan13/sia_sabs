<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_suratSakit extends Model
{
    protected $table = 'surat_sakits';

    protected $id_user_guruasrama = '';
    protected $tanggal = '';
    protected $keterangan = '';
    protected $id_siswa = '';
    
    protected $fillable = [
        'id_user_guruasrama',
        'tanggal',
        'keterangan',
        'id_siswa',
        
        
    ];
}
