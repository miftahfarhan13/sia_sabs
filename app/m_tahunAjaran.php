<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_tahunAjaran extends Model
{
    protected $table = 'sekolahs';
    protected $fillable = [
        'tahun_ajaran',
        'semester',
        'status',
    ];
}
