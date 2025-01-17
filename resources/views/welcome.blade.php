@extends('layouts.home')

@section('content')
    <div class="text-center w-full">
        <h1 class="text-4xl">Welcome to {{ $app_name }} </h1>
    </div>
    <div class="product-list mt-10">
        <div class="text-2xl">
            List Product
        </div>
        <div class="grid grid-cols-4 gap-4 mt-4">
            @foreach ($products as $product)
                <div class="border p-4">
                    <p class="text-lg font-bold">{{ $product->product_name }}</p>
                    <p class="text-sm">Price: {{ $product->product_price }}</p>
                    <div class="grid grid-cols-2 mt-5">
                        <form action="{{route('cartPage', $product->id)}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <x-primary-button>Add To Cart</x-primary-button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
