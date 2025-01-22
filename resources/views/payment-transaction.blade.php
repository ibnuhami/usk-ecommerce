<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction Payment') }}
        </h2>
    </x-slot>

    <div class="py-5 mx-16">
        <div class="border p-4 my-4 bg-white flex flex-col">

            <label for="product_name" class="mt-4">{{ __('Total Payment') }}</label>
            <x-text-input name="product_price" value="{{ $order->total }}" readOnly />

            <div class="mt-10">
                <form action="{{ route('transactionPaid') }}" method="post" class="inline-block">
                    @csrf
                    <input type="hidden" name="total_price" value="{{$order->total}}">
                    <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <x-primary-button type="submit">{{ __('Paid') }}</x-primary-button>
                </form>
                <form action="{{ route('cancelPayment') }}" method="post" class="inline-block">
                    @csrf
                    <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <x-secondary-button type="submit">{{ __('Cancel Paid') }}</x-secondary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
