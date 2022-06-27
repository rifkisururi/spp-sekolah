<?php 
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller{

    public function index(){
        if(Auth::check()){
            $data = DB::select("
            select k.id, k.nama_kelas , IFNULL(a.jmlTagihan, 0) jmlTagihan , IFNULL(b.jmlTagihan, 0) as lunas from kelas k 
            left join (
                select s.id_kelas, COUNT(*) as jmlTagihan  from spp s 
                group by s.id_kelas
            ) a on a.id_kelas = k.id 
            left join (
                select s.id_kelas, COUNT(*) as jmlTagihan  from spp s 
                where s.status = 'Lunas'
                group by s.id_kelas
            ) b on b.id_kelas = k.id 
            
            ");
            return view('dashboard', ['data' => $data]);
        }else{
            // login page
        }
    }

}

?>