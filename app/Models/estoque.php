<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @SWG\Definition(
 *      definition="estoque",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="qtd_estoque",
 *          description="qtd_estoque",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="ordem_id",
 *          description="ordem_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="data_producao",
 *          description="data_producao",
 *          type="string",
 *          format="date"
 *      )
 * )
 */
class estoque extends Model
{
    use SoftDeletes;


    public $table = 'estoque';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'qtd_estoque',
        'ordem_id',
        'data_producao',
        'produto_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'qtd_estoque' => 'integer',
        'ordem_id' => 'integer',
        'data_producao' => 'datetime:d/m/Y',
        'produto_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function ordems()
    {
        return $this->hasMany(\App\Models\ordem::class, 'id', 'ordem_id');
    }

    public function produtoss()
    {
        return $this->hasMany(\App\Models\producao::class, 'id', 'produtos_id');
    }
}
