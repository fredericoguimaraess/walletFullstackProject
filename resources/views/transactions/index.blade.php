@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Logs de Transações</h2>

    @foreach($transactions as $transaction)
    <div>
        <h4>Transação #{{ $transaction->id }}</h4>
        <p>Remetente: {{ $transaction->sender->name }}</p>
        <p>Destinatário: {{ $transaction->recipient->name }}</p>
        <p>Valor: R$ {{ $transaction->amount }}</p>
    </div>
    @endforeach
</div>
@endsection