<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('updateProduct', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-4">
                            <x-text-input name="product_name" placeholder="Product Name" value="{{$product->product_name}}" />
                            <x-text-input name="product_price" placeholder="Product Price" value="{{$product->product_price}}" />
                            <x-text-input name="product_stock" placeholder="Product Stock" value="{{$product->product_stock}}" />

                            <div class="grid-cols-2 mt-5">
                                <x-primary-button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 rounded w-1/4 px-2">Submit</x-primary-button>
                                <x-link href="{{route('dashboard')}}"
                                class="font-bold py-2 rounded w-1/4 px-2">Back</x-link>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
