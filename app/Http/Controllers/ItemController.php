<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Item; // Pastikan model diimpor

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = Item::all();
        $total_items = Item::count();
        return view('items.index', compact('items', 'total_items'));
    }


    public function store(Request $request)
    {
        Item::create($request->validate([
            'namaBarang' => 'required',
            'jumlah' => 'required|integer'
        ]));
        return redirect()->route('items.index');
    }
}
