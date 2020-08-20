<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use WithoutMiddleware;

class storePenilaianAkademikUnitTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();

        $data = [
            'id_user_gurusekolah' => '16515020',
            'id_mata_pelajaran' => 'SIA - 001',
            'id_user_siswa' => '151515',
            'id_kategori' => 'Pengetahuan',
            'tipe_nilai' => 'UAS',
            'nilai' => '90',
            'tahun_ajaran' => '2019/2020',
            'semester' => '2',
        ];
        
        $response = $this->post('/storeNilaiSekolahUnit', $data);

        $response->assertJson(['Data nilai berhasil diambil']);
    }
}
