<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_kritikDanSaran extends Model
{
    protected $table = 'kritik_dan_sarans';

    protected $id_orangtua = '';
    protected $tipe = '';
    protected $kritik = '';
    protected $saran = '';
    protected $tahun_ajaran = '';
    protected $semester = '';

    protected $fillable = [
        'id_orangtua',
        'tipe',
        'kritik',
        'saran',
        'tahun_ajaran',
        'semester',
        
    ];
}
