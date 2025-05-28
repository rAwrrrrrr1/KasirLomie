<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Menu;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $items = $request->input('items');
        $totalAmount = 0;

        foreach ($items as $item) {
            $menu = Menu::findOrFail($item['menu_id']);
            $totalAmount += $menu->price * $item['quantity'];
        }

        // Simpan transaksi
        $transaction = Transaction::create([
            'total_amount' => $totalAmount,
        ]);

        // Simpan item-item transaksi
        foreach ($items as $item) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'menu_id' => $item['menu_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        return response()->json([
            'message' => 'Transaksi berhasil disimpan.',
            'transaction_id' => $transaction->id,
        ], 201);
    }

    public function index()
    {
        return Transaction::with('items.menu')->latest()->get();
    }
}