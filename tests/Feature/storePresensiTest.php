<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class storePresensiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->post('/simpan_presensi/XA', ['id_user_siswa' => '167171', 'nama_kelas' => 'XA', 'keterangan' => 'Hadir']);
        
        $response->assertStatus(500);
        $response->assertJson([true]);
    }
}
