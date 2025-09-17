<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class os_usinagem
 * @package App\Models
 * @version February 21, 2024, 4:58 pm -03
 *
 * @property \Illuminate\Database\Eloquent\Collection $cncs
 * @property \Illuminate\Database\Eloquent\Collection $prototipos
 * @property integer $id_cnc
 * @property integer $id_prototipo
 * @property string $data_ini
 * @property string $data_fim
 */
class os_usinagem extends Model
{
    use SoftDeletes;


    public $table = 'os_usinagem';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'id_cnc',
        'id_prototipo',
        'data_ini',
        'data_fim'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_cnc' => 'integer',
        'id_prototipo' => 'integer',
        'data_ini' => 'datetime',
        'data_fim' => 'datetime'
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
    public function cncs()
    {
        return $this->hasMany(\App\Models\cnc::class, 'id', 'id_cnc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function prototipos()
    {
        return $this->hasMany(\App\Models\prototipos::class, 'id', 'id_prototipo');
    }
}
