<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction Your Chart') }}
        </h2>
    </x-slot>

    <div class="py-5 mx-16">
        <div class="border p-4 my-4 bg-white flex flex-col">
            <div class="my-5 flex flex-col">
                <label class="font-bold text-2xl">{{ __('Identity Store') }}</label>

                <label for="store_name" class="mt-4">{{ __('Store Name') }}</label>
                <x-text-input name="store_name"
                    value="{{ $cart->product->store->store_name }}" readOnly />

                <label for="store_address" class="mt-4">{{ __('Store Address') }}</label>
                <x-text-input name="store_address"
                    value="{{ $cart->product->store->store_address }}" readOnly />
            </div>

            <div class="my-5 flex flex-col">
                <label class="font-bold text-2xl">{{ __('Identity Product') }}</label>

                <label for="product_name" class="mt-4">{{ __('Product Name') }}</label>
                <x-text-input name="product_price"
                    value="{{ $cart->product->product_name }}" readOnly />

                <label for="product_price" class="mt-4">{{ __('Product Price') }}</label>
                <x-text-input name="product_price"
                    value="{{ $cart->product->product_price }}" readOnly />

                <label for="total_paid" class="mt-4">{{ __('Total Paid') }}</label>
                <x-text-input name="total_paid"
                    value="{{ $cart->product->product_price * $cart->quantity }}" readOnly />
            </div>

            <div class="mt-10">
                <form action="{{ route('transactionPayment') }}" method="post" class="inline-block">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$cart->product_id}}">
                    <input type="hidden" name="total_paid" value="{{ $cart->product->product_price * $cart->quantity }}" />
                    <input type="hidden" name="cart_id" value="{{ $cart->id }}" />
                    <x-primary-button type="submit">{{ __('Transaction') }}</x-primary-button>
                </form>
                <x-link href="{{ route('home') }}"> {{ __('Go To Home') }} </x-link>
            </div>
        </div>
    </div>
</x-app-layout>
