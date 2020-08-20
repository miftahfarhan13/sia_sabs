<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class storeNilaiAsramaIntegrationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {

        $data = [
            'id_user_guruasrama' => '16505020',
            'kode_materi' => 'ESE - 001',
            'id_siswa' => '151515',
            'kategori_materi' => 'Materi Pokok',
            'kelas' => "I/Bacaan(Qira'ah)",
            'tipe_nilai' => 'Keterangan',
            'keterangan' => 'Khatam',
        ];

        $user = User::find(1);
        $response = $this->actingAs($user)->post('/storeNilaiAsramaIntegrasi', $data);
        
        $response->assertStatus(200);
        $response->assertJson([
            'getDataNilai' => 'false',
            'pesan' => 'Data nilai asrama gagal ditambah',
            ]);
    }
}
