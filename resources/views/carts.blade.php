<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Carts') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 gap-4 mt-4">
                @foreach ($carts as $cart)
                    <div class="border p-4 my-4 bg-white">
                        <p class="text-lg font-bold">{{ $cart->product->product_name }}</p>
                        <p class="text-sm">Price: {{ $cart->product->product_price }}</p>
                        <p class="text-sm">Qty: {{ $cart->quantity }}</p>
                        <div class="grid grid-cols-2 mt-5 gap-5">
                            <x-link
                                href="{{ route('checkoutTransactionPage', $cart->id) }}">{{ __('Go To Transaction') }}</x-link>
                            <form action="{{route('cancelCart', $cart->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <x-danger-button type="submit">
                                    Cancel Cart
                                </x-danger-button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
