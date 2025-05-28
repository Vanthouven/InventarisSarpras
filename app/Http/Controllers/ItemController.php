<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Item; // Pastikan model diimpor

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
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
