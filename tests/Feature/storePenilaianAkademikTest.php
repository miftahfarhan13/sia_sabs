<?php

namespace Tests\Feature\Http\Controllers;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class storePenilaianAkademikTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $data = [
            'id_user_gurusekolah' => '16515020',
            'id_mata_pelajaran' => 'SIA - 001',
            'id_user_siswa' => '151515',
            'id_kategori' => 'Pengetahuan',
            'tipe_nilai_dropdown' => 'Ulangan Harian',
            'nilai' => '90',
            'tahun_ajaran' => '2019/2020',
            'semester' => '2',
        ];

        $user = User::find(1);
        $response = $this->actingAs($user)->post('/storeNilaiSekolahIntegrasi', $data);
        
        $response->assertStatus(200);
        $response->assertJson([
            'getDataNilai' => 'true',
            'pesan' => 'Data nilai ulangan harian berhasil ditambah',
            ]);
    }

}
