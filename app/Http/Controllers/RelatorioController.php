<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produto;
use App\Models\operador;
use App\Models\maquina;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function producao(Request $request)
    {
        $produtos = Produto::all();
        $operadores = Operador::all();
        $maquinas = Maquina::all();

        $query = DB::table('estoque')
            ->join('produtos', 'estoque.produto_id', '=', 'produtos.id')
            ->join('ordems', 'estoque.ordem_id', '=', 'ordems.id')
            ->join('maquinas', 'ordems.maquina_id', '=', 'maquinas.id')
            ->join('ordem_producaos', 'ordems.id', '=', 'ordem_producaos.ordem_id')
            ->join('producaos', 'ordem_producaos.producao_id', '=', 'producaos.id')
            ->join('operadors', 'producaos.operador_id', '=', 'operadors.id')
            ->select(
                'produtos.nome as produto_nome',
                'operadors.nome as operador_nome',
                'maquinas.nome as maquina_nome',
                DB::raw('DATE(estoque.data_producao) as data_producao'),
                DB::raw('SUM(estoque.qtd_estoque) as quantidade_total')
            )
            ->groupBy('produtos.nome', 'operadors.nome', 'maquinas.nome', 'data_producao');

        if ($request->filled('produto_id')) {
            $query->where('produtos.id', '=', $request->produto_id);
        }

        if ($request->filled('operador_id')) {
            $query->where('operadors.id', '=', $request->operador_id);
        }

        if ($request->filled('maquina_id')) {
            $query->where('maquinas.id', '=', $request->maquina_id);
        }

        if ($request->filled('data_inicio')) {
            $query->whereDate('estoque.data_producao', '>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')) {
            $query->whereDate('estoque.data_producao', '<=', $request->data_fim);
        }

        // Check if any filter parameters are present
        $hasFilters = $request->filled('produto_id') ||
                      $request->filled('operador_id') ||
                      $request->filled('maquina_id') ||
                      $request->filled('data_inicio') ||
                      $request->filled('data_fim');

        if ($hasFilters) {
            $data = $query->get();
            $total_quantidade = $data->sum('quantidade_total');
        } else {
            $data = collect(); // Return an empty collection if no filters
            $total_quantidade = 0;
        }
        
        return view('relatorios.producao', compact(
            'produtos',
            'operadores',
            'maquinas',
            'data',
            'total_quantidade'
        ));
    }
}
