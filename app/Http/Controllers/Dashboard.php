<?php 
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

class Dashboard extends Controller{

    public function index(){
        if(Auth::check()){
            return view('dashboard');
        }
        // return view('auth.login');
        // return "hallo";
    }

}

?>