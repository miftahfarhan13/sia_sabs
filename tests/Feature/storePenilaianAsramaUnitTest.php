<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use WithoutMiddleware;

class storePenilaianAsramaUnitTest extends TestCase
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
            'id_siswa' => '151515',
            'id_guruasrama' => '16505020',
            'kode_materi' => 'ASA - 003',
            'kategori_materi' => 'Materi Pokok',
            'kelas' => "I/Bacaan(Qira'ah)",
            'tipe_nilai' => 'Keterangan',
            'keterangan' => 'Khatam6',
            'tahun_ajaran' => '2019/2020',
            'semester' => '2',
        ];
        
        $response = $this->post('/storeNilaiAsramaUnit', $data);

        $response->assertJson(['Data nilai asrama telah dimasukkan sebelumnya']);
    }
}
