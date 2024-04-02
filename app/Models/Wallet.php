<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
    ];

    // Relação com o usuário (uma carteira pertence a um usuário)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relação com o histórico de transações (uma carteira tem várias transações)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
