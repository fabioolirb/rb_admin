<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class cor
 * @package App\Models
 * @version December 9, 2021, 10:11 am -03
 *
 * @property string $cor
 */
class cor extends Model
{
    use SoftDeletes;


    public $table = 'cors';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'cor',
        'referencia'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cor' => 'string',
        'referencia' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
