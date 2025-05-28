<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class DashboardController extends Controller
{
    public function index()
    {
        $total_items = Item::count();
        $latest_item = Item::latest()->first();
        return view('dashboard', compact('total_items', 'latest_item'));
    }
}
