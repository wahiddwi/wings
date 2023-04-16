@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @foreach ($products as $item)
            <div class="col-md-4 mb-5">
                <div class="card" style="width: 18rem;">
                    {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                    <img class="card-img-top" src="{{ url('uploads') }}/{{ $item->images }}" height="300" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">{{ $item->product_name }}</h5>
                      <p class="card-text">
                        <strong>Price :</strong> {{$item->currency}}. {{ number_format($item->discounted_price) }}<br>
                        <strong>Discount :</strong> {{$item->discount}}% <br>
                        <strong>Dimension :</strong> {{$item->dimension}}

                      </p>
                      <a href="{{ url('pesan') }}/{{ $item->id }}" class="btn btn-primary">Pesan</a>
                    </div>
                  </div>
            </div>
        @endforeach

    </div>
</div>
@endsection
