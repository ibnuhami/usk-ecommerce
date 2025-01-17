<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        /* Tailwind-like utility classes for PDF */
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 1rem;
        }

        .flex {
            display: flex;
        }

        .justify-between {
            justify-content: space-between;
        }

        .items-center {
            align-items: center;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .mt-8 {
            margin-top: 2rem;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .text-xl {
            font-size: 1.25rem;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .font-bold {
            font-weight: bold;
        }

        .text-gray-600 {
            color: #718096;
        }

        .bg-gray-100 {
            background-color: #f7fafc;
        }

        .p-4 {
            padding: 1rem;
        }

        .border-t {
            border-top: 1px solid #e2e8f0;
        }

        .border-b {
            border-bottom: 1px solid #e2e8f0;
        }

        .w-full {
            width: 100%;
        }

        .text-right {
            text-align: right;
        }

        /* Table styles */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            text-align: left;
        }

        .table th {
            background-color: #f7fafc;
            font-weight: bold;
        }

        .table tr:nth-child(even) {
            background-color: #f7fafc;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-xl font-bold">INVOICE</h1>
                <p class="text-gray-600">INV/{{ $transaction->transaction_number }}</p>
            </div>
            <div>
                <p class="font-bold text-xl">Store Name</p>
                <p class="text-gray-600"> {{ $order->product->store->store_name }} </p>
            </div>
        </div>

        <!-- Customer & Invoice Info -->
        <div class="flex justify-between mt-8">
            <div>
                <h2 class="text-lg font-bold mb-4">Billed To:</h2>
                <p> {{ $transaction->user->name }} </p>
                <p> {{ $transaction->user->email }} </p>
            </div>
            <div>
                <h2 class="text-lg font-bold mb-4">Invoice Details:</h2>
                <p>Invoice Date: {{ $transaction->created_at }} </p>
                <p>Payment Status: PAID</p>
            </div>
        </div>

        <!-- Products Table -->
        <div class="mt-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td> {{ $order->product->product_name }} </td>
                        <td> {{ $order->cart->quantity }} </td>
                        <td> {{ $order->total }} </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Summary -->
        <div class="mt-8">
            <div class="flex justify-between p-4 bg-gray-100">
                <div>
                    <p class="font-bold">Total:</p>
                </div>
                <div class="text-right">
                    <p class="font-bold"> {{ $order->total }} </p>
                </div>
            </div>
        </div>

        <!-- Payment Info -->
        <div class="mt-8 border-t pt-4">
            <h2 class="text-lg font-bold mb-4">Payment Information:</h2>
            <p>Bank: Bank USK Testing</p>
            <p>Account Number: 1234-5678-9012-3456</p>
            <p>Account Holder: PT Toko E-Commerce 21 Indonesia</p>
        </div>

        <!-- Footer -->
        <div class="mt-8 border-t pt-4 text-gray-600">
            <p>Thank you for your business!</p>
            <p>If you have any questions about this invoice, please contact:</p>
            <p>support@usk-ecommerce.id | +62 21 1234 5678</p>
        </div>
    </div>
</body>

</html>
