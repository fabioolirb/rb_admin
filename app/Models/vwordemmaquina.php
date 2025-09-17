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
 * @property \Illuminate\Database\Eloquent\Collection $vwordemmaquina
 * @property string $data
 * @property integer $imagem_id
 * @property integer $maquina_id
 * @property integer $turno_id
 * @property integer $operador_id
 */
class vwordemmaquina extends Model
{
    use SoftDeletes ,LogsActivity ;


    public $table = 'vw_ordem_maquina';

    protected $dates = ['deleted_at'];

    protected $info = array();

    public $fillable = [
        'nome',
        'nome_status',
        'nome_imagem',
        'nome_produtos',
        'cor',
        'link',
        'turno_id',
        'nome_turno'

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
        'nome',
        'nome_status',
        'nome_imagem',
        'nome_produtos',
        'cor',
        'link',
        'turno_id',
        'nome_turno'
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

    public function  maquina()  {
            return $this->get();
    }

}
