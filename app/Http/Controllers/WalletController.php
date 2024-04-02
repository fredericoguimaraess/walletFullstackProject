<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function transfer(Request $request)
    {
        // Validação dos dados recebidos (recipient_id, amount, etc.)
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $senderWallet = Wallet::where('user_id', auth()->id())->first();
        $recipientWallet = Wallet::where('user_id', $request->recipient_id)->first();

        // Valide o saldo do remetente
        if ($senderWallet->balance < $request->amount) {
            return redirect()->back()->with('error', 'Saldo insuficiente para a transferência.');
        }

        // Inicie uma transação de banco de dados
        DB::beginTransaction();

        try {
            // Deduza da carteira do remetente
            $senderWallet->balance -= $request->amount;
            $senderWallet->save();

            // Adicione à carteira do destinatário
            $recipientWallet->balance += $request->amount;
            $recipientWallet->save();

            // Registre a transação no histórico
            Transaction::create([
                'sender_id' => auth()->id(),
                'recipient_id' => $request->recipient_id,
                'amount' => $request->amount,
            ]);

            // Confirme a transação
            DB::commit();

            return redirect()->back()->with('success', 'Transferência realizada com sucesso.');
        } catch (\Exception $e) {
            // Desfaça a transação em caso de erro
            DB::rollback();
            return redirect()->back()->with('error', 'Falha na transferência. Tente novamente mais tarde.');
        }
    }

    public function create()
    {
        return view('wallet.create'); // Exibir formulário de criação de carteira
    }

    public function store(Request $request)
    {
        // Lógica para criar uma nova carteira para o usuário
        Wallet::create([
            'user_id' => auth()->id(),
            'balance' => 100, // Saldo inicial
        ]);

        return redirect('/dashboard');
    }

    public function showTransferForm()
    {
        return view('wallet.transfer'); // Exibir formulário de transferencia
    }
}
