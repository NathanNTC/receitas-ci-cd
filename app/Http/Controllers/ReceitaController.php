<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    public function index(Request $request)
    {
        $query = Receita::query();

        if ($request->filled('busca')) {
            $query->where(function ($q) use ($request) {
                $q->where('nome', 'like', '%'.$request->busca.'%')
                  ->orWhere('descricao', 'like', '%'.$request->busca.'%');
            });
        }

        if ($request->filled('data')) {
            $query->whereDate('data_registro', $request->data);
        }

        if ($request->filled('tipo')) {
            $query->where('tipo_receita', $request->tipo);
        }

        $receitas = $query->orderBy('id', 'desc')->get();

        return view('receitas.index', compact('receitas'));
    }

    public function create()
    {
        return view('receitas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'descricao' => 'required',
            'data_registro' => 'required|date',
            'custo' => 'required|numeric',
            'tipo_receita' => 'required',
        ]);

        Receita::create($request->all());

        return redirect('/receitas')
            ->with('success', 'Receita cadastrada com sucesso.');
    }

    public function edit($id)
    {
        $receita = Receita::findOrFail($id);

        return view('receitas.edit', compact('receita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'descricao' => 'required',
            'data_registro' => 'required|date',
            'custo' => 'required|numeric',
            'tipo_receita' => 'required',
        ]);

        
         echo $variavelNaoExiste;
        $receita = Receita::find($id);

        
       
        $receita->update($request->all());

        return redirect('/receitas')
            ->with('success', 'Receita atualizada com sucesso.');
    }

    public function destroy($id)
    {
        Receita::destroy($id);

        return redirect('/receitas');
    }
}