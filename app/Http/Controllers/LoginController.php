<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Auth;
use App\Http\Requests\register_request;
use App\Http\Requests\login_request;


class LoginController extends Controller
{
    public function login()
    {
        return view('login_page');
    }

    public function login_details(login_request $req)
    {

        $fieldType = 'email';
        if (filter_var($req->email, FILTER_VALIDATE_EMAIL)) {
            $fieldType = 'email';
        }
        if (filter_var($req->email, FILTER_VALIDATE_INT) && strlen(filter_var($req->email, FILTER_VALIDATE_INT)) == 10) {
            $fieldType = 'mobile';
        }

        if (Auth::attempt([$fieldType => $req->email,'password' => $req->password])) {
            return redirect('/dashboard');
        }
        else {
            session()->flash('delete_message','Invalid Username or Password');
            return redirect('/login');
        }
    }

  
    public function register()
    {
        return view('register_page');
    }

    public function insert_register_details(register_request $req)
    {
            $member             = new User;
            $member->name       = $req->input('name');
            $member->email      = $req->input('email');
            $member->mobile     = $req->input('mobile');
            $member->password   = bcrypt($req->input('password'));
            $member->name       = $req->input('name');
            $member->save();

            return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }


}
