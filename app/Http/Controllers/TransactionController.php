<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Exibe uma lista das transações do usuário.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::where('sender_id', auth()->id())
            ->orWhere('recipient_id', auth()->id())
            ->get();

        return view('transactions.index', compact('transactions'));
    }
}
