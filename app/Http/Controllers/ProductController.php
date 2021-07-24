<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allproduct = product::with('category')->get();
        $allcategory = Category::all();
        $pro = product::paginate(3);
        return view('products.index',compact('allproduct','allcategory','pro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:150|unique:products',
            'price' => 'required|string',
            'quantity' => 'required|string',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif'
        ],['name.required'=> 'no name',
           'name.unique'=>'this product is exist',
           'price.required'=>'please insert image'
        ]);
        
        $fileextension = $request->image->getClientOriginalExtension();
        $filename = uniqid('',true).'.'.$fileextension;
        $path = 'images/products';
        $request -> image -> move($path,$filename);
        $input = $request->all();
        $b_exist = product::where('name','=',$input['name'])->exists();
        if($b_exist){
            session()->flash('Error','Name Is exists');
            return redirect('/product');
        }else{
            session()->flash('Add','Added Succesfully');
         
        product::create([
            'name'=> $request->name,
            'price'=> $request->price,
            'cat_id'=> $request->cat_id,
            'quantity'=> $request->quantity,
            'image'=>$filename
        ]);
        return redirect('/product');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $Product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = product::findOrFail($id);
        return response()->json($data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       

        $this->validate($request, [
            'name' => 'required|string|max:150',
            'price' => 'required|string',
            'quantity' => 'required|string',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif'
        ]);

            // dd($request->name);

            $data = product::findOrFail($request->id);
            $data->name = $request->name;
            $data->price = $request->price;
            $data->quantity = $request->quantity;
            if($request->hasFile('image')){
                $fileextension = $request->image->getClientOriginalExtension();
                $filename = uniqid('',true).'.'.$fileextension;
                $path = 'images/products';
                $request -> image -> move($path,$filename);
                $data->image = $filename;
            }
            $data->save();
      
                session()->flash('Update','Updated Succesfully');
                return back();
            

           
        
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        product::findOrFail($id)->delete();
        session()->flash('Delete','Deleted Succesfully');

        return response()->json(['message'=>'deleted succfully','id'=>$id]);
    }
}
