<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_bobotNilai extends Model
{
    protected $table = 'bobot_penilaians';
    protected $fillable = [
        'id_user_gurusekolah',
        'KKM',
        'ulangan_harian',
        'uts',
        'uas',
    ];
}
