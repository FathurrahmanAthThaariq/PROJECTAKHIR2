<?php

namespace App\Http\Controllers\Frontend;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class CartController extends Controller
{
    private $client;
    private $url;
    private $headers;
    private $body;

    public function __construct()
    {
        SEOMeta::setTitleDefault(getSettings('site_name'));
        parent::__construct();
        $this->headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
        $this->client = new Client([
            'headers' => $this->headers
        ]);
        $this->url = "localhost:8082/api/carts";
    }

    private function setMeta(string $title)
    {
        SEOMeta::setTitle($title);
        OpenGraph::setTitle(SEOMeta::getTitle());
        JsonLd::setTitle(SEOMeta::getTitle());
    }

    public function index()
    {
        $this->setMeta('Cart');
        $carts = Cart::where('user_id', auth()->user()->id)->with('product')->get();
        return view('pages.frontend.cart.index', compact('carts'));
    }

    public function store(Request $request)
    {
        $this->setMeta('Cart');

        // check if product is available
        $product = Product::find($request->product_id);
        if ($product->quantity < $request->quantity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product is not available'
            ]);
        }

        // check if product is already in cart
        $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $request->product_id)->first();
        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Product added to cart'
            ]);
        }
        $cart = new Cart();
        $cart->user_id = auth()->user()->id;
        $cart->product_id = $request->product_id;
        $cart->quantity = $request->quantity;
        $cart->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->setMeta('Cart');

        $cart = Cart::find($id);
        if ($cart->quantity > $request->quantity) {
            $product = Product::find($cart->product_id);
            if ($product->quantity < $cart->quantity - $request->quantity) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product is not available'
                ]);
            }
        }
        $cart->quantity = $request->quantity;
        $cart->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Cart updated'
        ]);
    }

    public function destroy($id)
    {
        $this->setMeta('Cart');

        $cart = Cart::find($id);
        $cart->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Cart deleted'
        ]);
    }
}
