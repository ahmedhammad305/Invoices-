<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\sections;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();

        $products = products::all();

        return view('products.products',['sections' => $sections ,'products'=> $products]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $Product_name = request()->Product_name;
        $description = request()->description;
        $section_name = request()->section_id;
        $post = new products;
        $post->Product_name = $Product_name;
        $post->description = $description;
        $post->section_id = $section_name;
        $post->save();
        return to_route('products.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storee(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edite($postid)
    {
        $postFromview = products::findOrFail($postid);
        $sections = sections::all();
        return view('products.ProductEdite',['post' => $postFromview, 'sections'=>$sections]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update($post_id, Request $request)
    {
        // Get the request of data
        //validate data request
        $validaterequest = $request->validate([

            'Product_name' => 'required|unique:products|max:255',
            'description' => 'required',
            'section_id'=> 'required'
        ],
        [
            'Product_name.required'=> 'يرجي ادخال اسم المنتح',
            'description.required' =>'يرجي ادخال البيان',
        ]);
        $postFromview = products::findOrFail($post_id);

        $Product_name = request()->Product_name;
        $description = request()->description;
        $section_id =request()->section_id;

        $singlePostFromDB =products::find($post_id);

        $singlePostFromDB->update([
            'Product_name'=> $Product_name,

            'description'=> $description,
            'section_name'=>$section_id
        ]);
        session()->flash('edit','تم تعديل المنتج بنجاج');
        return to_route('products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($postid)
    {
        $post = products::find($postid);

        $post->delete();

        return to_route('products.index');
    }
}
