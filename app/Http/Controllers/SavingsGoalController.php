<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavingsGoal;

class SavingsGoalController extends Controller
{
    public function index()
    {
        // Exibe uma lista das metas de economia do usuário
        $savingsGoals = auth()->user()->savingsGoals;
        return view('savings-goals.index', compact('savingsGoals'));
    }

    public function create()
    {
        // Exibe o formulário para criar uma nova meta de economia
        return view('savings-goals.create');
    }

    public function store(Request $request)
    {
        // Valida os dados de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0.01',
            'deadline' => 'required|date',
        ]);

        // Cria uma nova meta de economia para o usuário
        $savingsGoal = new SavingsGoal([
            'name' => $request->name,
            'target_amount' => $request->target_amount,
            'deadline' => $request->deadline,
        ]);
        auth()->user()->savingsGoals()->save($savingsGoal);

        return redirect()->route('savings-goals.index')->with('success', 'Meta de economia criada com sucesso.');
    }

    public function edit(SavingsGoal $savingsGoal)
    {
        // Exibe o formulário para editar uma meta de economia existente
        return view('savings-goals.edit', compact('savingsGoal'));
    }

    public function update(Request $request, SavingsGoal $savingsGoal)
    {
        // Valida os dados de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0.01',
            'deadline' => 'required|date',
        ]);

        // Atualiza a meta de economia existente
        $savingsGoal->update($request->all());

        return redirect()->route('savings-goals.index')->with('success', 'Meta de economia atualizada com sucesso.');
    }

    public function destroy(SavingsGoal $savingsGoal)
    {
        // Exclui uma meta de economia
        $savingsGoal->delete();

        return redirect()->route('savings-goals.index')->with('success', 'Meta de economia excluída com sucesso.');
    }
}
