@extends('layouts.app')


@section('content')
<div class="container">

    <h2>Dashboard</h2>
    <p>Bem-vindo, {{ auth()->user()->name }}!</p>

    <h3>Sua Carteira</h3>

    @if(auth()->user()->wallet)
    <p>Saldo: R$ {{ auth()->user()->wallet->balance }}</p>
    @else
    <p>Você ainda não tem uma carteira. <a href="{{ route('wallet.create') }}">Crie uma agora</a>.</p>
    @endif

    <h3>Metas de Economia</h3>
    @foreach(auth()->user()->savingsGoals as $savingsGoal)
    <div>
        <h4>{{ $savingsGoal->name }}</h4>
        <p>Valor Alvo: R$ {{ $savingsGoal->target_amount }}</p>
        <p>Prazo: {{ $savingsGoal->deadline }}</p>
    </div>
    @endforeach
    <a href="{{ route('transactions.index') }}" class="btn btn-primary">Ver Logs de Transações</a>
    <a href="{{ route('wallet.transfer') }}" class="btn btn-primary">Transferir Dinheiro</a>
    <a href="{{ route('savings-goals.create') }}" class="btn btn-primary">Criar Meta de Economia</a>
    <a href="{{ route('externalApi.getExchangeRate') }}" class="btn btn-primary">Mercado Financeiro</a>
    <a href="{{ route('externalApi.getEconomyData') }}" class="btn btn-primary">Dados Econômicos</a>
</div>
@endsection