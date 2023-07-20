<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Facades\Validator;
use App\Services\Midtrans\CreateSnapTokenService;

class CheckoutController extends Controller
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
        return view('pages.frontend.checkout.index', compact('cities', 'carts'));
    }

    public function check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city' => 'required',
            'courier' => 'required',
            'address' => 'required',
            'name' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'success'
        ]);
    }


    public function store(Request $request)
    {
        $carts = auth()->user()->carts;
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->product->price * $cart->quantity;
        }

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'total' => $total,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
        ]);

        foreach ($carts as $cart) {
            $order->orderItems()->create([
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
            ]);
        }

        $carts->each->delete();

        return redirect()->route('checkout.show', $order->id);
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $this->setMeta('Checkout');
        return view('pages.frontend.checkout.show', compact('order', 'snapToken'));
    }
}
