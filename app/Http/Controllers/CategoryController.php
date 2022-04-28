<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
// use Yajra\DataTables\DataTablesServiceProvider as Datatables;
use DataTables;
use App\Http\Requests\cat_add_request;
use App\Http\Requests\cat_update_request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Ht
     * tp\Response
     */
    public function index(Request $request)
    {        
            if ($request->ajax()) {
                $model = Category::all();
                return DataTables::of($model)
                    ->addIndexColumn()
                    ->addColumn('category_name', '{{$category_name}}')
                    ->addColumn('status', '{{$status == 0 ? "Active" : "Inactive"}}')
                    ->addColumn('edit',function($model){
                        return '<a href="'.url("cat_edit/".$model->id).'" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                        <a href="'.url("cat_delete/".$model->id).'" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>';
                    })
                    ->rawColumns(['edit'])
                    ->make(true);   
            }
            return view('cat_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view("cat_add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(cat_add_request $request)
    {
        $cat                 = new Category();
        $cat->category_name  = $request->category_name;
        $cat->status         = $request->status;
        $cat->save();

        session()->flash('flash_message','Category Added successfully');

        return redirect('category');
    }
    // public function store(cat_add_request $request)
    // {
    //     dd($request->all());
    //     $cat                 = new Category();
    //     $cat->category_name  = $request->category_name;
    //     $cat->status         = $request->status;
    //     $cat->save();
        
    //     return redirect('category')->with('success','category Added successfully');
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
            return view("cat_edit",compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(cat_update_request $request, $id)
    {
        $category = Category::findOrFail($id);
        if (!$category) {
            return redirect('category');
        }
       
        $category                   = Category::find($id);
        $category->category_name    = $request->category_name;
        $category->status           = $request->status;
        $category->save();

        session()->flash('flash_message','Category Updated successfully');
        return redirect('category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::find($id);
        $data->delete();
        session()->flash('delete_message','Category deleted succesfully');

        return redirect("category");
    }
}
