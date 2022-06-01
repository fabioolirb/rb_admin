<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


/**
 * Class producao
 * @package App\Models
 * @version January 3, 2022, 4:46 pm -03
 *
 * @property \Illuminate\Database\Eloquent\Collection $producaos
 * @property string $data
 * @property integer $imagem_id
 * @property integer $maquina_id
 * @property integer $turno_id
 * @property integer $operador_id
 */
class producao extends Model
{
    use SoftDeletes;


    public $table = 'producaos';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'data',
        'imagem_id',
        'maquina_id',
        'turno_id',
        'operador_id',
        'qtd_diario'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'data' => 'datetime:d/m/Y',
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
        return $this->belongsToMany(\App\Models\producao::class, 'ordem_producao', 'producao_id', 'id');
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

    public function vw_producaos (){
           //$sql = 'Select * from vw_producaos where isnull(deleted_at)';

        $result = DB::table('vw_producaos')->wherenull('deleted_at');
         return $result;

    }

}
