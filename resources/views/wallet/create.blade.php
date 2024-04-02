@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Criar Carteira</h2>
    <form action="{{ route('wallet.store') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Criar Carteira</button>
    </form>
</div>
@endsection