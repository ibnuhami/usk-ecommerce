<?php

namespace App\Http\Controllers;

use App\Enum\UserType;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $admin = UserType::Admin->value;
        return view('dashboard', compact('admin'));
    }
}
