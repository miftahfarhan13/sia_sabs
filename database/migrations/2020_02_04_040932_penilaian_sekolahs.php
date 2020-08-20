<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PenilaianSekolahs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_sekolahs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_user_siswa');
            $table->string('id_user_gurusekolah');
            $table->string('id_mata_pelajaran_sekolah');
            $table->string('sikap_berpendapat');
            $table->string('presentasi');
            $table->string('menghargai_pendapat');
            $table->string('kebenaran_konsep');
            $table->string('kerja_sama');
            $table->string('kreatif');

            $table->string('jumlah_score_keterampilan');
            
            $table->string('nilai_keterampilan');
            $table->string('rasa_ingin_tahu');
            $table->string('teliti');
            $table->string('disiplin');
            $table->string('tanggung_jawab');
            $table->string('keterangan_sikap');

            $table->string('nilai_harian');
            $table->string('uts');
            $table->string('uas');
            $table->string('nilai_akhir');
            $table->string('pembagi_nilai');
            $table->string('tahun_ajaran');
            $table->string('semester');
            $table->string('kkm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
