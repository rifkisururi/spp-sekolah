<?php

namespace App\Http\Controllers;

use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\SppModel;
use App\Models\PeriodeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class Spp extends Controller
{
    public function index(){
        
        $kelas = DB::table('kelas')->get();
        $siswa = DB::table('siswa')->get();
        $periode = DB::table('periode')->get();
        
        $data = DB::table('spp')
            ->join('kelas', 'spp.id_kelas', '=', 'kelas.id')
            ->join('siswa', 'spp.id_siswa', '=', 'siswa.id')
            ->join('periode', 'spp.id_periode', '=', 'periode.id')

            ->select('spp.*', 'kelas.nama_kelas as kelas', 'siswa.nama as siswa', 'periode.nama as periode')
            ->get();

        return view('spp.index', ['data' => $data, 'kelas' => $kelas, 'siswa' => $siswa, 'periode' => $periode]);
    }

    public function store(Request $request){
        $data = new SppModel($request->all());
        // cek dulu data nya sudah pernah dimasukkan atau belum
        $count = DB::table('spp')->where(['id_siswa' => $data->id_siswa, 'id_periode' => $data->id_periode])->count();
        if($count == 0){
            $data->save();
            return response()->json(array(
                'success' => true,
                'last_insert_id' => $data->id
            ), 200);
        }else {
            return response()->json(array(
                'success' => false
            ), 200);
        }
        
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = SppModel::find($id);
        $data->id_kelas = $request->id_kelas;
        $data->id_siswa = $request->id_siswa;
        $data->id_periode = $request->id_periode;
        $data->tanggal_pembayaran = $request->tanggal_pembayaran;
        $data->biaya = $request->biaya;
        $data->status = $request->status;
        $data->save();

        return response()->json(array(
            'success' => true
        ), 200);
    }

    public function hapus(Request $request)
    {
        SppModel::where('id',$request->id)->delete();
        return response()->json(array(
            'success' => true
        ), 200);
    }

    public function laporan($tgl = null){
        $data = DB::table('spp')
            ->join('kelas', 'spp.id_kelas', '=', 'kelas.id')
            ->join('siswa', 'spp.id_siswa', '=', 'siswa.id')
            ->join('periode', 'spp.id_periode', '=', 'periode.id')
            ->where('spp.tanggal_pembayaran','=',$tgl)
            ->where('spp.status','=','Lunas')
            ->select('spp.*', 'kelas.nama_kelas as kelas', 'siswa.nama as siswa', 'periode.nama as periode')
            ->get();

        return view('spp.laporan', ['data' => $data]);
    }

    public function cetak($id){
        $data = DB::table('spp')
            ->join('siswa', 'spp.id_siswa', '=', 'siswa.id')
            ->where('spp.id','=',$id)
            ->select('siswa.nama', 'spp.biaya', 'spp.tanggal_pembayaran as tanggal')
            ->get();
        $data = $data[0];
        $pdf = PDF::loadview('spp.cetak', ['data' => $data]);
    	return $pdf->download('Notta.pdf');
    }
}
