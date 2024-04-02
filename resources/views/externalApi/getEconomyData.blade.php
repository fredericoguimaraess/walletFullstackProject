@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Dados Econômicos</h2>

    @if(isset($economicData['error']))
    <div class="alert alert-danger" role="alert">
        {{ $economicData['error'] }}
    </div>
    @else
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $economicData['realtime_start'] }}</h5>
            <p class="card-text">ID da Série: {{ $economicData['series_id'] }}</p>
            <p class="card-text">Última Atualização: {{ $economicData['realtime_end'] }}</p>
        </div>
    </div>

    <h3 class="mb-3">Observações</h3>
    @foreach($economicData['observations'] as $observation)
    <div class="card mb-3">
        <div class="card-body">
            <p class="card-text">Valor: {{ $observation['value'] }}</p>
        </div>
    </div>
    @endforeach
    @endif
</div>
@endsection