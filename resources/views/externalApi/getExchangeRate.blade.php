@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Dados da Ação</h2>

    @if(isset($stockData['Error Message']))
    <div class="alert alert-danger" role="alert">
        {{ $stockData['Error Message'] }}
    </div>
    @else
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $stockData['Meta Data']['2. Symbol'] }}</h5>
            <p class="card-text">Última atualização: {{ $stockData['Meta Data']['3. Last Refreshed'] }}</p>
        </div>
    </div>

    <h3 class="mb-3">Série Temporal (Diária)</h3>
    @foreach($stockData['Time Series (Daily)'] as $date => $data)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $date }}</h5>
            <p class="card-text">Abertura: {{ $data['1. open'] }}</p>
            <p class="card-text">Alta: {{ $data['2. high'] }}</p>
            <p class="card-text">Baixa: {{ $data['3. low'] }}</p>
            <p class="card-text">Fechamento: {{ $data['4. close'] }}</p>
        </div>
    </div>
    @endforeach
    @endif
</div>
@endsection