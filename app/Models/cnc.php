<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class cnc
 * @package App\Models
 * @version February 21, 2024, 4:27 pm -03
 *
 * @property string $desc_cnc
 */
class cnc extends Model
{
    use SoftDeletes;


    public $table = 'cnc';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'desc_cnc'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'desc_cnc' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
