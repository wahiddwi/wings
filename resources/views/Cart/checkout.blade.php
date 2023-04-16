@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('home') }}" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h3>Halaman Checkout</h3>
                    <p align="right">Tanggal Pesanan : {{ $transactionHeader->created_at }}</p>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;?>
                            @foreach ($transactionDetail as $details)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$details->products->product_name}}</td>
                                <td>{{$details->quantity}}</td>
                                <td>{{ $details->products->currency }} .{{ number_format($details->products->discounted_price)}}</td>
                                <td>{{ $details->products->currency }} .{{ number_format($details->sub_total)}}</td>
                                <td>
                                    <form action="{{ url('checkout') }}/{{ $details->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" align="right">Total Harga</td>
                                <td>IDR .{{ number_format($transactionHeader->total)}}</td>
                                <td>
                                    <a href="{{ url('comfirm-checkout') }}" class="btn btn-primary">Konfirmasi</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
