<?php 
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\KelasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;

class Kelas extends Controller{

    public function index(){
        
        $data = DB::table('kelas')->get();
        return view('kelas.index', ['data' => $data]);
    }
    public function store(Request $request){
        $data = new KelasModel($request->all());
        $data->save();
        return response()->json(array(
            'success' => true,
            'last_insert_id' => $data->id
        ), 200);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = KelasModel::find($id);
        $data->nama_kelas = $request->nama_kelas;
        $data->spp = $request->spp;
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