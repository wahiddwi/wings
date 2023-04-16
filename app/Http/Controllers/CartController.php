<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use RealRashid\SweetAlert\Facades\Alert;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $products = Product::where('id', $id)->first();

        return view('Cart.index', compact('products'));
    }

    public function order(Request $request, $id)
    {
        // dd($request);
        $products = Product::where('id', $id)->first();

        // store to table transaction header
        $cek_status = TransactionHeader::where('user_id', $id)->where('status', 0)->first();
        if (empty($cek_status)) {
            # code...
            $order = new TransactionHeader;
            $order->user_id = Auth::user()->id;
            $order->date = Carbon::now();
            $order->status = 0; // 1 = jika sudah dipesan
            // $order->total = $products->discounted_price * $request->quantity;
            $order->total = 0;
            $order->save();
        }

        $newOrder = TransactionHeader::where('user_id', Auth::user()->id)->where('status', 0)->first();

        $cek_pesanan_detail = TransactionDetail::where('product_code', $products->id)->where('document_code', $newOrder->id)->first();
        // cek pesanan detail
        if (empty($cek_pesanan_detail)) {
            # code...
            $orderDetail = new TransactionDetail;
            $orderDetail->product_code = $products->id;
            $orderDetail->document_code = $newOrder->id;
            $orderDetail->quantity = $request->quantity;
            $orderDetail->sub_total = $products->discounted_price * $request->quantity;
            $orderDetail->save();
        } else {
            $orderDetail = TransactionDetail::where('product_code', $products->id)->where('document_code', $newOrder->id)->first();
            $orderDetail->quantity = $orderDetail->quantity + $request->quantity;
            // price new order detail
            $priceNewOrderDetail = $products->discounted_price * $request->quantity;
            $orderDetail->sub_total = $orderDetail->discounted_price + $priceNewOrderDetail;
            $orderDetail->update();
        }

        // jumlah total
        $orders = TransactionHeader::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $orders->total = $orders->total + $products->discounted_price * $request->quantity;
        $orders->update();
        // Alert::success('Success', 'Pesanan anda berhasil');
        return redirect('checkout');
    }

    public function checkout()
    {
        $transactionHeader = TransactionHeader::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $transactionDetail = TransactionDetail::where('document_code', $transactionHeader->id)->get();

        return view('Cart.checkout', compact('transactionHeader', 'transactionDetail'));
    }

    public function delete($id)
    {
        $transactionDetail = TransactionDetail::where('id', $id)->first();
        // sebelum dkihapus jumlah harga dikurangi dulu
        $transactionHeader = TransactionHeader::where('id', $transactionDetail->document_code)->first();
        $transactionHeader->total = $transactionHeader->total - $transactionDetail->sub_total;
        $transactionHeader->update();

        $transactionDetail->delete();
        Alert::success('Success', 'Pesanan anda berhasil dihapus');
        return redirect('checkout');
    }

    public function confirmation()
    {
        $orders = TransactionHeader::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $orders->status = 1; // status pesanan jadi 1
        $orders->update();
        Alert::success('Success', 'Pesanan anda berhasil dikonfirmasi');
        return redirect('home');
    }

    public function report()
    {
        $report = TransactionDetail::with('products', 'transactionHeaders')->get();
        // $report = TransactionDetail::all();
        // $pesanan = TransactionDetail::all();

        return view('Cart.report_penjualan', ['report' => $report]);
    }
}
