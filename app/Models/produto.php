<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


/**
 * Class produto
 * @package App\Models
 * @version December 10, 2021, 2:21 pm -03
 *
 * @property \App\Models\categoria $categoria
 * @property integer $nome
 * @property integer $referencia
 * @property integer $prazo_producao
 * @property integer $categoria_id
 */
class produto extends Model
{
    use SoftDeletes,LogsActivity;


    public $table = 'produtos';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'opencart_product_id',
        'nome',
        'referencia',
        'prazo_producao',
        'categoria_id'
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
        'opencart_product_id' => 'integer',
        'nome' => 'string',
        'referencia' => 'string',
        'prazo_producao' => 'integer',
        'categoria_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function categorias()
    {
        return $this->hasOne(\App\Models\categoria::class, 'id', 'categoria_id');
    }


    public function vw_produtos($produto_id,$imagem_id){

       // return $produtos = (array) DB::select('select * from vw_produtos where produto_id = ?',['produto_id'=>$produto_id]);

        $produtos = DB::table('vw_produtos')
                                ->where('imagem_id','=',$imagem_id)
                                ->where('produto_id','=',$produto_id)->get()->toArray();

        return  $produtos;
    }

}
