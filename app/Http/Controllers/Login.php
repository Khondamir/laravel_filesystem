<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use App\User;
use App\Regions;
use App\File;
use App\SecondForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class Login extends Controller
{
    //
    public $info_data = array();
 
    public function index()
    {
        return view('login');
    }  
 
    public function registration()
    {
        return view('registration');
    }
     
    public function postLogin(Request $request)
    {
        request()->validate([
        'email' => 'required',
        'password' => 'required',
        ]);
 
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            	return redirect()->intended('dashboard');
            }
        return Redirect::to("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
 
    public function postRegistration(Request $request)
    {  
        request()->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        ]);
         
        $data = $request->all();
 
        $check = $this->create($data);
       
        return Redirect::to("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
     
    public function dashboard()
    {
      $regions = Regions::All();
      if(Auth::check() && Auth()->User()->name == 'Khondamirbek'){
        $info_data   = Session::get( 'info_data' );
        $data        = File::latest()->paginate(5);
        $second_data = SecondForm::All()->where('status', 'yuborildi');
      	return view('admin', compact('data', 'second_data', 'regions', 'info_data'))->with('i', (request()->input('page', 1) - 1) * 5);
      
      }

      else if(Auth::check()){

        $data = File::All()->where('status', 'Qabul qilindi');
        return view('dashboard', compact('regions', 'data'));
      
      }
       return Redirect::to("login")->withSuccess('Opps! You do not have access');
    }
 
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
     
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
