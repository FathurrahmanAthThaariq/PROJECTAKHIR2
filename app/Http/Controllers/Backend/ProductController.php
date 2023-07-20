<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $messages;

    public function __construct()
    {
        SEOMeta::setTitleDefault(getSettings('site_name'));
        parent::__construct();
        $this->messages = [
            'name.required' => 'Name is required',
            'description.required' => 'Description is required',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'quantity.required' => 'Quantity is required',
            'quantity.numeric' => 'Quantity must be a number',
            'image.required' => 'Image is required',
            'image.image' => 'Image must be an image',
            'image.mimes' => 'Image must be jpeg, png, jpg, gif, svg',
            'image.max' => 'Image must be less than 2MB',
            'category_id.required' => 'Category is required',
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
        $this->setMeta('Products');
        $products = Product::with('category')->get();
        return view('pages.backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setMeta('Create Product');
        $categories = Category::all();
        return view('pages.backend.products.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|numeric',

        ], $this->messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ]);
        }

        // move image to public folder
        $image = $request->file('image');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/products'), $image_name);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $image_name,
            'category_id' => $request->category_id,

        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product created successfully',
            'redirect' => route('backend.products.index'),
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
        $this->setMeta('Edit Product');
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('pages.backend.products.edit', compact('product', 'categories'));
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
        // validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|numeric',

        ], $this->messages);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ]);
        }
        $image_name = $request->old_image;
        if ($request->hasFile('image')) {
            // delete old image
            $old_image = public_path('images/products/') . $request->old_image;
            if (file_exists($old_image)) {
                unlink($old_image);
            }
            // move image to public folder
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $image_name);
        }

        Product::findOrFail($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => (int) $request->price,
            'quantity' => (int) $request->quantity,
            'image' => $image_name,
            'category_id' => (int) $request->category_id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully',
            'redirect' => route('backend.products.index'),
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
        // delete product
        $product = Product::findOrFail($id);
        $image_path = public_path('images/products/' . $product->image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $product->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted successfully',
        ]);
    }

    public function addStock(Product $product)
    {
        return view('pages.backend.products.modals.add_stock', compact('product'));
    }

    public function updateStock(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric',
        ], $this->messages);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ]);
        }
        $product->update([
            'quantity' => $product->quantity + (int) $request->quantity,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Stock updated successfully',
            'redirect' => route('backend.products.index'),
        ]);
    }
}
