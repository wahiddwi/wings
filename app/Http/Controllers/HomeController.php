<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TransactionDetail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
        // dd($products);
        return view('home', compact('products'));
    }

    public function report()
    {
        $data = TransactionDetail::with('products', 'transactionHeaders')->get();

        return view('report_penjualan', compact($data));
    }
}
