<?php

namespace App\Repositories;

use App\Models\producao;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class producaoRepository
 * @package App\Repositories
 * @version January 3, 2022, 4:46 pm -03
*/

class producaoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'data',
        'data_ini',
        'data_fim',
        'imagem_id',
        'maquina_id',
        'turno_id',
        'operador_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return producao::class;
    }
    public function getTotalProducao(){
        $query = DB::table('vw_total_producao')->select('*');
        return $query->get();
    }


    public function getProducao(){
        $query = DB::table('vw_producao')->select('*')->orderBy('data_producao','desc');
        return $query->get();

    }

    public function getTotalProducaoSemana(){
        $query = DB::table('vw_toltal_producao_maquina')
            ->select(DB::raw('sum(qtd_estoque) as qtd_estoque'),  DB::raw("WEEKDAY(data_producao) as semana_producao"),  DB::raw("WEEK(data_producao) as nr_semana_producao"),  DB::raw("data_producao"))
            ->groupBy(DB::raw('WEEKDAY(data_producao)'),DB::raw('WEEK(data_producao)'),DB::raw('data_producao'))
            ->orderByDesc('nr_semana_producao','semana_producao');
 //dd($query->toSql());
        return $query->get();
    }

    public function getProducaoMaquina(){
        $query = DB::table('vw_toltal_producao_maquina')
            ->select('nome_maquina',DB::raw('sum(qtd_estoque) as qtd_estoque'),  DB::raw("data_producao"))
            ->groupBy('nome_maquina',DB::raw('data_producao'))
            ->orderByDesc('nome_maquina','data_producao');
        //dd($query->toSql());
        return $query->get();
    }

}
