<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allcategory = Category::all();
       return view('categories.index',compact('allcategory'));
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
    
       $input = $request->all();
       $b_exists =category::where('name','=',$input['name'])->exists();
       if($b_exists){
           session()->flash('Error','Name is exists');
           return redirect('/category');
       }else{
        session()->flash('Add','Added Succesfully');
           Category::create([
               'name'=>$request->name
           ]);
           return redirect('/category');
       }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $Category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:150'
        ]);
        $data = Category::findOrFail($request->id);
        $data->name = $request->name;
        $data->save();
        session()->flash('Update','Updated Succesfully');
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Category::findOrFail($id)->delete();
       session()->flash('Delete','Deleted Succfully');
       return response()->json(['message'=>'deleted succfully','id'=>$id]);
    }
}
