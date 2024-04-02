@extends('layouts.app')

@section('content')
<h1>Meta de Poupança</h1>
<a href="{{ route('savings-goals.create') }}" class="btn btn-primary">Crie uma nova meta</a>

<table class="table mt-3">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Valor desejado</th>
            <th>Prazo final</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($savingsGoals as $goal)
        <tr>
            <td>{{ $goal->name }}</td>
            <td>{{ $goal->target_amount }}</td>
            <td>{{ \Carbon\Carbon::parse($goal->deadline)->format('d-m-Y') }}</td>
            <td>
                <a href="{{ route('savings-goals.edit', $goal) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('savings-goals.destroy', $goal) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-primary">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
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