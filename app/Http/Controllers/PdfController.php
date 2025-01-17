<?php

namespace App\Http\Controllers;

use App\Repository\OrderRepository;
use App\Repository\TransactionRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class PdfController extends Controller
{
    public function reportPaymentOrder($orderId)
    {
        try {
            $order = (new OrderRepository)->getById($orderId);
            $transaction = (new TransactionRepository)->getByOrderId($order->id);
            $pdf_file = Pdf::loadView('report.transaction-report', compact('order', 'transaction'));
            $name_file = 'Invoice-' . time() . '-' . auth()->user()->name . '.usk-ecommerce.pdf';
            return $pdf_file->download($name_file);
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
            return "Something Went Wrong at Report Payment";
        }
    }
}
