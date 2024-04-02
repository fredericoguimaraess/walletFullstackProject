@extends('layouts.app')

@section('content')
<h1>Edit Savings Goal</h1>
<form action="{{ route('savings-goals.update', $savingsGoal) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nome da Meta</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $savingsGoal->name }}" required>
    </div>
    <div class="form-group">
        <label for="target_amount">Valor desejado</label>
        <input type="number" name="target_amount" id="target_amount" class="form-control" step="0.01" value="{{ $savingsGoal->target_amount }}" required>
    </div>
    <div class="form-group">
        <label for="deadline">Prazo final</label>
        <input type="date" name="deadline" id="deadline" class="form-control" value="{{ \Carbon\Carbon::parse($savingsGoal->deadline)->format('d-m-Y') }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar Meta</button>
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