@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('home') }}" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ url('uploads') }}/{{$products->images}}" class="rounded mx-auto d-block" width="100%" alt="" srcset="">
                        </div>
                        <div class="col-md-6 mt-4">
                            <h3>{{ $products->product_name }}</h3>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Harga</td>
                                        <td>:</td>
                                        {{-- <td>{{$products->currency}}. {{ number_format($products->price) }}</td> --}}
                                        {{-- <td>{{$products->currency}}. {{ number_format({{ App\Product::getDiscountedPriceAttribute() }}) }}</td> --}}
                                        <td>{{ $products->discounted_price }}</td>
                                    </tr>
                                    <tr>
                                        <td>Unit</td>
                                        <td>:</td>
                                        <td>{{$products->unit}}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td>:</td>
                                        <td>{{$products->discount}}%</td>
                                    </tr>
                                    <tr>
                                        <td>Dimension</td>
                                        <td>:</td>
                                        <td>{{$products->dimension}}</td>
                                    </tr>
                                    <form action="{{ url('pesan') }}/{{$products->id}}" method="post">
                                        @csrf
                                        <tr>
                                            <td>Quantity</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" name="quantity" class="form-control" required>
                                                <button type="submit" class="btn btn-primary mt-2"><i class="bi bi-cart2"></i> Pembelian</button>
                                            </form>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
