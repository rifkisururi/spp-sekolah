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
            $kelas = '';
            //$data = DB::select('');

            return view('dashboard');
        }else{
            // login page
        }
    }

}

?>