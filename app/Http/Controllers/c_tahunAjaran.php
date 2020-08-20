<?php

namespace App\Http\Controllers;

use App\m_tahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class c_tahunAjaran extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $tahunajaran = DB::table('sekolahs')->get();

        return view('/kelola_tahun_ajaran',['tahunajaran'=>$tahunajaran]);
    }

    public function getCountTahunAjaran($tahunajaran, $semester){
        $tahunajaran = DB::table('sekolahs')->where('tahun_ajaran', $tahunajaran)->where('semester', $semester)->count();    
        return $tahunajaran;
    }

    public function storeTahunAjaran(Request $request){
        $tahun_ajaran = $request->get('tahun_ajaran');
        $semester =  $request->get('semester');
        $getTahunAjaran = $this->getCountTahunAjaran($tahun_ajaran, $semester);

        $tahunajaran = new m_tahunAjaran([
            'tahun_ajaran'=> $tahun_ajaran,
            'semester'=> $semester,
        ]);

        if($getTahunAjaran == 0){
            $tahunajaran->timestamps = false;
            $tahunajaran->save();
            return response()->json([true]);
        }else{
            return response()->json([false]);
        }
    }

    public function updateTahunAjaranTidakAktif(Request $request){
        DB::table('sekolahs')->update(['status' => $request->get('status')]);
        return response()->json([true]);
    }

    public function updateTahunAjaran(Request $request){
        DB::table('sekolahs')
                ->where('id', $request->get('id'))
                ->update(['status' => $request->get('status')]);
       
        return response()->json([true]);
    }


}
