<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private $messages;

    public function __construct()
    {
        SEOMeta::setTitleDefault(getSettings('site_name'));
        parent::__construct();
        $this->messages = [
            'name.required' => 'Name is required',
            'description.required' => 'Description is required',
            'image.required' => 'Image is required',
            'image.image' => 'Image must be an image',
            'image.mimes' => 'Image must be jpeg, png, jpg, gif, svg',
            'image.max' => 'Image must be less than 2MB'
        ];
    }
    private function setMeta(string $title)
    {
        SEOMeta::setTitle($title);
        OpenGraph::setTitle(SEOMeta::getTitle());
        JsonLd::setTitle(SEOMeta::getTitle());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setMeta('Categories');
        $categories = Category::all();
        return view('pages.backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setMeta('Create Category');
        return view('pages.backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            $this->messages
        );
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        // move image to public folder
        $image = $request->file('image');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/categories'), $image_name);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image_name
        ]);

        return response([
            'status' => 'success',
            'message' => 'Category ' . $request->name . ' created successfully',
            'redirect' => route('backend.categories.index')
        ]);
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
        $this->setMeta('Edit Category');
        $category = Category::findOrFail($id);
        return view('pages.backend.categories.edit', compact('category'));
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
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            $this->messages
        );
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }
        $image_name = $request->old_image;
        if ($request->hasFile('image')) {
            // delete old image from public folder
            $image_path = public_path('images/categories/' . $request->old_image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            // move image to public folder
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
        }

        Category::findOrFail($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image_name
        ]);

        return response([
            'status' => 'success',
            'message' => 'Category ' . $request->name . ' updated successfully',
            'redirect' => route('backend.categories.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete image from public folder
        $category = Category::findOrFail($id);
        $image_path = public_path('images/categories/' . $category->image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $category->delete();
        return response([
            'status' => 'success',
            'message' => 'Category ' . $category->name . ' deleted successfully',
        ]);
    }
}
