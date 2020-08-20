<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class simpanPresensiSekolahUnitTest extends TestCase
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
            'kelas' => 'XB',
            'keterangan' => '',
            'tanggal' => '2020-04-23',
            'tahun_ajaran' => '2019/2020',
            'semester' => '2',
        ];
        
        $response = $this->post('/simpanPresensiSekolahUnit', $data);

        $response->assertJson(['Silahkan isi data presensi']);
    }
}
