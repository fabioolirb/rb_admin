<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


/**
 * Class producao
 * @package App\Models
 * @version January 3, 2022, 4:46 pm -03
 *
 * @property \Illuminate\Database\Eloquent\Collection $vwproducao
 * @property string $data
 * @property integer $imagem_id
 * @property integer $maquina_id
 * @property integer $turno_id
 * @property integer $operador_id
 */
class vwproducao extends Model
{
    use SoftDeletes ,LogsActivity ;


    public $table = 'vw_producaos';

    protected $dates = ['deleted_at'];

    protected $info = array();

    public $fillable = [
        'id',
        'ordem_id',
        'maquina_id',
        'data_ini',
        'data_end',
        'producao_id',
        'data',
        'imagem_id',
        'turno_id',
        'operador_id',
        'qtd_diario',
        'turnos_nome',
        'nome',
        'imagem_produtos_nome',
        'link',
        'produto_id',
        'cor_id',
        'cor',
        'referencia',
        'deleted_at',
        'updated_at',
        'created_at',
        'status_ordem_id',
        'qtd_producao'

    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
    }

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'data' => 'date',
        'imagem_id' => 'integer',
        'maquina_id' => 'integer',
        'turno_id' => 'integer',
        'operador_id' => 'integer',
        'qtd_diario' =>'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/

    public function producaos()
    {
        return $this->belongsToMany(\App\Models\producao::class, 'ordem_producao', 'ordem_id', 'id');
    }

    public function imagems()
    {
        return  $this->hasMany(\App\Models\imagem_produto::class,'imagem_id','id');
    }

    public function maquina()
    {
        return $this->hasMany(\App\Models\maquina::class, 'maquina_id', 'id');
    }

    public function turno()
    {
        return $this->hasMany(\App\Models\turno::class, 'turno_id', 'id');
    }

    public function operador()
    {
        return $this->hasMany(\App\Models\operador::class, 'operador_id', 'id');
    }

    public function  order_id($id){
        return $this->where('ordem_id', $id)->get();
    }

    public function  status_ordem(){
        return $this->hasMany(\App\Models\status_ordem::class, 'status_ordem_id', 'id');
    }

}
