<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class OrderController extends Controller
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
        $this->setMeta('Orders');
        $orders = Order::all();
        return view('pages.backend.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->setMeta('Order Detail');
        return view('pages.backend.orders.show', compact('order'));
    }

    public function approve(Order $order)
    {
        $order->update([
            'status' => 'approved'
        ]);
        return redirect()->back()->with('success', 'Order has been approved');
    }

    public function reject(Order $order)
    {
        $order->update([
            'status' => 'rejected'
        ]);
        return redirect()->back()->with('success', 'Order has been rejected');
    }
}
