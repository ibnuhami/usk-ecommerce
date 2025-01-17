<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('insertProduct') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-4">
                            <label for="product_name" class="mt-2">{{__('Product Name')}}</label>
                            <x-text-input name="product_name" placeholder="Your Product Name" />

                            <label for="product_price" class="mt-2">{{__('Product Price')}}</label>
                            <x-text-input name="product_price" placeholder="Your Product Price" />

                            <label for="product_stock" class="mt-2">{{__("Product Stock")}}</label>
                            <x-text-input name="product_stock" placeholder="Your Product Stock" />

                            <div class="grid-cols-2 mt-5">
                                <x-primary-button type="submit"
                                class="font-bold py-2 rounded w-1/4 px-2">Submit</x-primary-button>
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
