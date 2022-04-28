<?php

namespace App\Http\Controllers\Catgory;

use App\Http\Controllers\Controller;
use App\Models\Category;
use DataTables;
use App\Http\Requests\cat_add_request;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {        
        if ($request->ajax()) {
            $model = Category::all();
            $path='category';
            return DataTables::of($model)
                ->addIndexColumn()
                ->addColumn('category_name', '{{$category_name}}')
                ->addColumn('status', '{{$status == 0 ? "Active" : "Inactive"}}')
                ->addColumn('edit',function($model){
                    return '<a href="'.url("edit-category/".$model->id).'" class="btn btn-warning btn-xs">Edit</a>
                    <a href="'.url("delete-category/".$model->id).'" class="btn btn-danger btn-xs">delete</a>';
                })
                ->rawColumns(['edit'])
                ->make(true);   
        }
        return view('cat_list');
    }

    public function catCreate()
    {
        return view('cat_add');
    }

    public function catStore(cat_add_request $request)
    {
        // dd($request->all());
        $cat                 = new Category();
        $cat->category_name  = $request->category_name;
        $cat->status         = $request->status;
        $cat->save();
        
        return redirect('category')->with('success','category Added successfully');
    }
}
