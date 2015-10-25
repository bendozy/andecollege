<?php

namespace AndeCollege\Http\Controllers;

use Validator;
use AndeCollege\Category;
use AndeCollege\Resource;
use Illuminate\Http\Request;
use AndeCollege\Http\Requests;
use Illuminate\Support\Facades\Auth;
use AndeCollege\Http\Controllers\Controller;
use AndeCollege\Http\Requests\ResourceCreateRequest;
use AndeCollege\AndeCollege\Repository\CategoryRepository;
use AndeCollege\AndeCollege\Repository\ResourceRepository;

class ResourceController extends Controller
{
    private $categoryRepository;
    private $resourceRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
        $this->resourceRepository = new  ResourceRepository();
    }
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
        return view('pages.resource_create', compact('categories'));
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
        $resource = Resource::find($id);
        $categories = Category::all();

        if ($resource) {
            return view('pages.resource_show', compact('categories', 'resource'));
        }

        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resource = Resource::find($id);
        $categories = Category::all();

        if ($resource) {
            return view('pages.resource_edit', compact('categories', 'resource'));
        }

        return abort(404);
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
        $resource = Resource::find($id);
        if ($resource) {
            if ($request->user()->cannot('update-resource', $resource)) {
                abort(403);
            }

            $this->sanitizeInput($request);
            $validator = $this->validator($request->all(), $id);

            if ($validator->fails()) {
                return redirect(route('resource.edit', ['id' =>$resource->id]))
                    ->withInput()
                    ->withErrors($validator);
            }

            $resource->title = $request->input('name');
            $resource->link = $request->input('url');
            $resource->cat_id = $request->input('category');
            $resource->description = $request->input('description');
            $resource->save();

            return redirect(route('index'))->with('status', 'Resource Updated Successfully');
        }
        abort(404);
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

    /**
     * Show all resource that belong to a category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resourceCategory($name)
    {
        $categories = Category::all();
        $category = $this->categoryRepository->findCategoryByName($name);
        $resources =  $this->resourceRepository->findResourcesByCategory($category);
        $title = 'Resource(s) for '.$name;

        return view('pages.resources', compact('categories', 'resources', 'title'));
    }

    /**
     * Sanitize the Input.
     *
     */
    public function sanitizeInput(Request $request)
    {
        $input = $request->all();
        $input['title'] = trim(filter_var($request->input('title'), FILTER_SANITIZE_STRING));
        $input['description'] = trim(filter_var($request->input('description'), FILTER_SANITIZE_STRING));
        $request->replace($input);
    }

    /**
     * Get a validator for an incoming update request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, $id)
    {
        return Validator::make($data, [
            'title' => 'required|max:255|min:3|unique:resources,title,'.$id,
            'url' =>  'required|unique:resources,link,'.$id,
            'category' => 'required',
            'description' => 'required'
        ]);
    }
}
