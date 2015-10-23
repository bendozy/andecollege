<?php

namespace AndeCollege\Http\Controllers;

use AndeCollege\Category;
use AndeCollege\Resource;
use Illuminate\Http\Request;
use AndeCollege\Http\Requests;
use Illuminate\Support\Facades\Auth;
use AndeCollege\Http\Controllers\Controller;
use AndeCollege\Http\Requests\ResourceCreateRequest;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    return view('pages.resources');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $categories = Category::all();
        return view('pages.resource_create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResourceCreateRequest $request)
    {
	    Resource::create([
		    'title' => $request->input('title'),
		    'description' => $request->input('description'),
		    'cat_id' => $request->input('category'),
		    'link' => $request->input('url'),
		    'user_id' => Auth::user()->id
	    ]);
	    return redirect(route('index'))->with('status', 'Resource Created Successfully');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
