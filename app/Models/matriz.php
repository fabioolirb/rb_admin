<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @SWG\Definition(
 *      definition="matriz",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="linha",
 *          description="linha",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="coluna",
 *          description="coluna",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="produto_id",
 *          description="produto_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="quantidade",
 *          description="quantidade",
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
 *      )
 * )
 */
class matriz extends Model
{
    use SoftDeletes;


    public $table = 'matriz';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'linha',
        'coluna',
        'produto_id',
        'quantidade'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'linha' => 'string',
        'coluna' => 'string',
        'produto_id' => 'integer',
        'quantidade' => 'integer'
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
    public function produtos()
    {
        return $this->hasMany(\App\Models\produto::class, 'id', 'produto_id');
    }


}
