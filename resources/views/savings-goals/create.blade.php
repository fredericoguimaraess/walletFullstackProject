@extends('layouts.app')

@section('content')
<h1>Meta de Poupança</h1>
<form action="{{ route('savings-goals.create') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">Nome da meta</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="target_amount">Valor desejado</label>
        <input type="number" name="target_amount" id="target_amount" class="form-control" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="deadline">Prazo final</label>
        <input type="date" name="deadline" id="deadline" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Criar Meta</button>
</form>
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