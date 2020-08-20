<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BobotPenilaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bobot_penilaians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('KKM');
            $table->string('pembagi_nilai');
            $table->string('ulangan_harian');
            $table->string('uts');
            $table->string('uas');
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
