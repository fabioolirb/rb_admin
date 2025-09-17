<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


/**
 * Class ordem
 * @package App\Models
 * @version January 3, 2022, 3:47 pm -03
 *
 * @property \Illuminate\Database\Eloquent\Collection $ordems
 * @property string $data_ini
 * @property string $data_end
 */
class ordem extends Model
{
    use SoftDeletes;

    public $table = 'ordems';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id',
        'data_ini',
        'data_end',
        'maquina_id',
        'status_ordem_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'data_ini' => 'date:d/m/Y' ,
        'data_end' => 'date:d/m/Y',
        'maquina_id' => 'integer',
        'status_ordem_id' => 'integer'
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
    public function ordems()
    {
        return $this->belongsToMany(\App\Models\ordem::class, 'ordem_producaos', 'ordem_id', 'producao_id');
    }

     public function ordems_cors()
     {
         return $this->belongsToMany(\App\Models\ordem::class, 'order_cors', 'ordem_id', 'id');
     }

    public function status()
    {
        return $this->belongsTo(status_ordem::class, 'status_ordem_id','id');
      //  return $this->hasMany(\App\Models\status_ordem::class, 'id', 'status_ordem_id');
    }
    public function  getproduct($id){

        return DB::table('ordems')
            ->join('ordem_producaos','ordem_producaos.ordem_id','=','ordems.id')
            ->join('producaos','ordem_producaos.producao_id','=','producaos.id')
            ->join('imagem_produtos', 'producaos.imagem_id','=','imagem_produtos.id')
            ->join('produtos' ,'imagem_produtos.produto_id','=','produtos.id')
            ->select('produtos.id', 'produtos.nome')
            ->where('ordems.id','=',$id)->get();
    }

}
