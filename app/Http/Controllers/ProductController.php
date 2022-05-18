<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
// use Yajra\DataTables\DataTablesServiceProvider as Datatables;
use DataTables;
use App\Http\Requests\prod_add_request;
use App\Http\Requests\prod_update_request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Product::all();
            return Datatables::of($model)
            ->addIndexColumn()
            ->addColumn('product_sku', '{{ $product_sku }}')
            ->addColumn('product_name', '{{ $product_name }}')
            ->addColumn('category_id',function($model){
                return $model->leftjoin('categories','products.category_id','categories.id')->where('products.id',$model->id)->pluck('category_name')->first();
            })
            ->addColumn('status', '{{ $status == 0 ? "Active" : "Inactive" }}')
            ->addColumn('edit',function($model){
                return '<a href="'.route("prod_edit",[$model->id]).'" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                
                <a href="'.route("prod_delete",[$model->id]).'" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>';
            })
            ->rawColumns(['edit'])
            ->make(true); 
        }
        return view('prod_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $category = Category::where('status',0)->get();
        return view('prod_add',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(prod_add_request $request)
    {
        $product                = new Product();
        $product->product_sku   = $request->product_sku;
        $product->product_name  = $request->product_name;
        $product->category_id    = $request->category;
        $product->status        = $request->status;
        $product->save();
        session()->flash('flash_message','Product Added successfully');

        return redirect('product');
    }

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
        $product = Product::find($id);
        $category = Category::where('status',0)->get();
        return view('prod_edit',compact('product','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(prod_update_request $request, $id)
    {
        $product                = Product::find($id);
        $product->product_sku   = $request->product_sku;
        $product->product_name  = $request->product_name;
        $product->category_id   = $request->category;
        $product->status        = $request->status;
        $product->save();
        session()->flash('flash_message','Product Updated successfully');
        return redirect('product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::find($id);
        $data->delete();
        session()->flash('delete_message','Product deleted succesfully');

        return redirect("product");
    }
}
