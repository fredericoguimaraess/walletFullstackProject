@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Transferir Dinheiro</h2>
    <form action="{{ route('wallet.transfer') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="recipient_id">ID do Destinatário</label>
            <input type="text" name="recipient_id" id="recipient_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="amount">Quantidade</label>
            <input type="number" step="0.01" name="amount" id="amount" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Transferir</button>
    </form>
</div>
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@endsection