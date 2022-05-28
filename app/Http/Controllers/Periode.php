<?php 
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\PeriodeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;

class Periode extends Controller{

    public function index(){
        
        $data = DB::table('periode')->get();
        return view('periode.index', ['data' => $data]);
    }
    
    public function store(Request $request){
        $data = new PeriodeModel($request->all());
        $data->save();
        return response()->json(array(
            'success' => true,
            'last_insert_id' => $data->id
        ), 200);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = PeriodeModel::find($id);
        $data->nama = $request->nama;
        $data->tanggal_jatuh_tempo = $request->tanggal_jatuh_tempo;
        $data->save();

        return response()->json(array(
            'success' => true
        ), 200);
    }

    public function hapus(Request $request)
    {
        PeriodeModel::where('id',$request->id)->delete();
        return response()->json(array(
            'success' => true
        ), 200);
    }
}

?>