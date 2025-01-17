<div class="mt-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900" data-user-id="{{ auth()->user()->store_id }}">
                <div class="grid grid-cols-5 mb-5">
                    <h2 class="text-2xl font-bold col-span-4">{{ __('Your Product Order') }}</h2>
                </div>
                <table id="order-table" class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-4 text-left text-sm font-medium text-gray-500">ID</th>
                            <th class="p-4 text-left text-sm font-medium text-gray-500">Product Name</th>
                            <th class="p-4 text-left text-sm font-medium text-gray-500">Price</th>
                            <th class="p-4 text-left text-sm font-medium text-gray-500">Buyer</th>
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
    const orderTableColumn = document.getElementById('order-table').querySelector('tbody');
    document.addEventListener('DOMContentLoaded', async () => {
        try {
            const userId = document.querySelector('[data-user-id]').getAttribute('data-user-id');

            const routeOrderByStore = `${window.location.origin}/order/by-store/${userId}`;
            const response = await fetch(routeOrderByStore);
            const data = await response.json()
            data.forEach((item, iteration) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                        <td class="p-4 text-sm text-gray-500">${iteration + 1}</td>
                        <td class="p-4 text-sm text-gray-500">${item.product.product_name}</td>
                        <td class="p-4 text-sm text-gray-500">${item.product.product_price}</td>
                        <td class="p-4 text-sm text-gray-500">${item.user.name}</td>
                        <td class="p-4 text-sm text-gray-500">
                            <form action="${window.location.origin}/order/confirm/${item.id}" method="POST">
                                @csrf
                                @method('PUT')
                                <x-primary-button class="inline-block font-bold py-2 px-4 rounded">Confirm</x-primary-button>
                            </form>
                        </td>
                    `;
                orderTableColumn.appendChild(tr);
            });
        } catch (error) {
            console.error(error);
        }
    });
</script>
