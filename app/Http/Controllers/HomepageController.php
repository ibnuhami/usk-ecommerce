<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        if(!auth()->user()) {
            (new AuthenticatedSessionController)->destroy(request());
        }
        $paginate = request()->query('paginate');
        $app_name = config('app.name');
        $products = (new ProductRepository)->getProduct($paginate = 10);
        return view('welcome', compact('app_name', 'products'));
    }
}
