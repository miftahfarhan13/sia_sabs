<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_orangTua extends Model
{
    protected $table = 'orang_tua';
    protected $fillable = [
        'id_orangtua',
        'nama',
    ];
}
