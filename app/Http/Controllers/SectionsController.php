<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SectionsController;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        return view('sections.sections',['sections'=> $sections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validaterequest = $request->validate([

            'section_name' => 'required|unique:sections|max:255',

            'description' => 'required',
        ],[

            'section_name.required'=> 'يرجي ادخال اسم القسم',

            'section_name.unique'=> 'يرجي ادخال اسم القسم',

            'description.required' =>'يرجي ادخال البيان',
        ]);

        sections::create([

            'section_name'=>$request->section_name,

            'description'=> $request->description,

            'Created_by'=> (Auth::user()->name),
        ]);

        session()->flash('Add','تم اضافه القسم بنجاج');

        return to_route( route:'section.com');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */

    public function edite($post_id ){

        $postFromview = sections::findOrFail($post_id);

        return view('sections.SectionsEdite',['post' => $postFromview]);
    }
    public function update($postid ,Request $request){

        $validaterequest = $request->validate([

            'section_name' => 'required|unique:sections|max:255',

            'description' => 'required',
        ],
        [
            'section_name.required'=> 'يرجي ادخال اسم القسم',

            'section_name.unique'=> 'القسم موجود بالفعل',
            'description.required' =>'يرجي ادخال البيان',
        ]);

        $postFromview = sections::findOrFail($postid);

        $section_name = request()->section_name;

        $description = request()->description;

        $singlePostFromDB =sections::find($postid);

        $singlePostFromDB->update([
            'section_name'=> $section_name,

            'description'=> $description,
            'Created_by'=> Auth()->User()->name
        ]);
        session()->flash('edit','تم تعديل القسم بنجاج');
        return to_route('section.com');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, sections $sections)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy($posstid)
    {
        $post = sections::find($posstid);

        $post->delete();

        return to_route('section.com');
    }
}
