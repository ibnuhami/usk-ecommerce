<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction Success') }}
        </h2>
    </x-slot>

    <div class="py-5 mx-16">
        <div class="border p-4 my-4 bg-white flex flex-col">
            <p>Thank you For Buying {{$cart->product->product_name}} 😻 </p>
            <form action="{{ route('reportPaymentOrder', $order->id) }}" method="post" class="inline-block mt-5">
                @csrf
                <x-primary-button type="submit">Download Invoice</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
