    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-5 mb-5">
                        <h2 class="text-2xl font-bold col-span-4">{{ __('Your Products List') }}</h2>
                        <a href="{{ route('createProductPage') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">Add
                            Product</a>
                    </div>
                    <table id="product-table" class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-4 text-left text-sm font-medium text-gray-500">ID</th>
                                <th class="p-4 text-left text-sm font-medium text-gray-500">Name</th>
                                <th class="p-4 text-left text-sm font-medium text-gray-500">Price</th>
                                <th class="p-4 text-left text-sm font-medium text-gray-500">Stock</th>
                                <th class="p-4 text-left text-sm font-medium text-gray-500">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        "use strict";
        const productTableColumn = document.getElementById('product-table').querySelector('tbody');
        window.onload = async () => {
            try {
                const route = `${window.location.origin}/product-by-store`;
                const response = await fetch(route);
                const {
                    data
                } = await response.json();
                data.forEach((product, iteration) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                            <td class="p-4 text-sm text-gray-500">${iteration + 1}</td>
                            <td class="p-4 text-sm text-gray-500">${product.product_name}</td>
                            <td class="p-4 text-sm text-gray-500">${product.product_price}</td>
                            <td class="p-4 text-sm text-gray-500">${product.product_stock}</td>
                            <td class="p-4 text-sm text-gray-500">
                                <x-link href="${window.location.origin}/product/${product.id}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</x-link>
                                <form action="${window.location.origin}/product/${product.id}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                </form>
                            </td>
                        `;
                    productTableColumn.appendChild(tr);
                });
            } catch (error) {
                console.error(error);
            }
        };
    </script>
