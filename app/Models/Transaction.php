<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id', // ID do usuário remetente
        'recipient_id', // ID do usuário destinatário
        'amount', // Valor da transferência
    ];

    // Relação com o remetente (uma transação pertence a um usuário remetente)
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relação com o destinatário (uma transação pertence a um usuário destinatário)
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
