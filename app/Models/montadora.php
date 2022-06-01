<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


/**
 * Class montadora
 * @package App\Models
 * @version March 15, 2022, 3:34 pm -03
 *
 * @property \Illuminate\Database\Eloquent\Collection $cidades
 * @property \Illuminate\Database\Eloquent\Collection $estados
 * @property string $nome
 * @property integer $fone
 * @property integer $contrato
 * @property string $logradouro
 * @property string $bairro
 * @property integer $nr
 * @property integer $cidade_id
 * @property integer $estado_id
 */
class montadora extends Model
{
    use SoftDeletes , LogsActivity;


    public $table = 'montadora';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'nome',
        'fone',
        'ddd',
        'contrato',
        'logradouro',
        'bairro',
        'nr',
        'cidade_id',
        'estado_id'
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
        'nome' => 'string',
        'ddd' => 'integer',
        'fone' => 'integer',
        'contrato' => 'integer',
        'logradouro' => 'string',
        'bairro' => 'string',
        'nr' => 'integer',
        'cidade_id' => 'integer',
        'estado_id' => 'integer'
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
    public function cidades()
    {
        return $this->belongsTo(\App\Models\Cidade::class, 'cidade_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function estados()
    {
        return $this->belongsTo(\App\Models\Estados::class, 'estado_id', 'id');
    }
}
