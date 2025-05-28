<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $total = 0;
        foreach ($request->items as $item) {
            $menu = \App\Models\Menu::find($item['menu_id']);
            $total += $menu->price * $item['quantity'];
        }

        $transaction = Transaction::create(['total_amount' => $total]);

        foreach ($request->items as $item) {
            $menu = \App\Models\Menu::find($item['menu_id']);
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'menu_id' => $item['menu_id'],
                'quantity' => $item['quantity'],
                'subtotal' => $menu->price * $item['quantity'],
            ]);
        }

        return response()->json(['message' => 'Transaction created', 'total' => $total]);
    }

    public function index()
    {
        return Transaction::with('items.menu')->latest()->get();
    }
}