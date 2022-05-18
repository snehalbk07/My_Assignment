<?php

namespace App\Http\Controllers;
use DB;
use DataTables;
use App\Models\User;
use App\Http\Requests\user_add_request;
use App\Http\Requests\user_update_request;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {        
            if ($request->ajax()) {
                $model = User::all();
                return DataTables::of($model)
                    ->addIndexColumn()
                    ->addColumn('name', '{{$name}}')
                    ->addColumn('edit',function($model){
                        return '<a href="'.url("user_edit/".$model->id).'" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                        <a href="'.url("user_delete/".$model->id).'" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>';
                    })
                    ->rawColumns(['edit'])
                    ->make(true);   
            }
            return view('user_list');
    }

    public function create(Request $request)
    {
        return view("user_add");
    }

    public function store(user_add_request $request)
    {
        $user               = new User();
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->mobile       = $request->mobile;
        $user->password     = bcrypt($request->password);
        $user->role     = 1;
        $user->save();

        session()->flash('flash_message','User Added successfully');

        return redirect('users');
    }

    public function edit($id)
    {
        $member = User::find($id);
            return view("user_edit",compact('member'));
    }


    public function update(user_update_request $request, $id)
    {
        $member = User::findOrFail($id);
        if (!$member) {
            return redirect('users');
        }
       
        $member                   = User::find($id);
        $member->name             = $request->name;
        $member->email            = $request->email;
        $member->mobile           = $request->mobile;
        if ($request->password) {
            $member->password     = bcrypt($request->password);
        }
        $member->save();

        session()->flash('flash_message','User Updated successfully');
        return redirect('users');
    }

    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();
        session()->flash('delete_message','User deleted succesfully');

        return redirect("users");
    }




}
