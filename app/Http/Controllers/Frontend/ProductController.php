<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class ProductController extends Controller
{

    public function __construct()
    {
        SEOMeta::setTitleDefault(getSettings('site_name'));
        parent::__construct();
    }

    private function setMeta(string $title)
    {
        SEOMeta::setTitle($title);
        OpenGraph::setTitle(SEOMeta::getTitle());
        JsonLd::setTitle(SEOMeta::getTitle());
    }
    public function index()
    {
        $this->setMeta('Products');
        $products = Product::with('category')->get();
        return view('pages.frontend.product.index', compact('products'));
    }
    public function show($id)
    {
        $this->setMeta('Product');
        $product = Product::with('category')->findOrFail($id);
        return view('pages.frontend.product.show', compact('product'));
    }
}
