<?php 
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;

class Siswa extends Controller{

    public function index(){
        
        $kelas = DB::table('kelas')->get();
        $data = DB::table('siswa')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->select('siswa.*', 'kelas.nama_kelas as kelas')
            ->get();
        return view('siswa.index', ['data' => $data, 'kelas' => $kelas]);
    }

    public function store(Request $request){
        $data = new SiswaModel($request->all());
        $data->save();
        return response()->json(array(
            'success' => true,
            'last_insert_id' => $data->id
        ), 200);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = SiswaModel::find($id);
        $data->nis = $request->nis;
        $data->nama = $request->nama;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->id_kelas = $request->id_kelas;
        $data->save();

        return response()->json(array(
            'success' => true
        ), 200);
    }

    public function hapus(Request $request)
    {
        KelasModel::where('id',$request->id)->delete();
        return response()->json(array(
            'success' => true
        ), 200);
    }
}

?>