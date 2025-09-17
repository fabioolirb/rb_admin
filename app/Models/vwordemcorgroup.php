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
 * @property \Illuminate\Database\Eloquent\Collection $vwordemcorgroup
 * @property string  $data
 * @property integer $id_ordem
 * @property string  $nome
 * @property string  $cor
 * @property string  $referencia
 * @property integer $id_cor
 */
class vwordemcorgroup extends Model
{
    use SoftDeletes ,LogsActivity ;


    public $table = 'vw_ordem_cor';

    protected $dates = ['deleted_at'];

    protected $info = array();

    public $fillable = [
        'id',
        'id_ordem',
        'nome',
        'cor',
        'referencia',
        'id_cor',
        'maquina_id',
        'maquina_nome',
        'status_ordem_id'
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
        'id_ordem' =>'integer',
        'nome',
        'cor',
        'referencia',
        'id_cor' =>'integer'

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

    public function  ordem($id){
        return $this->where('id_ordem', $id)->get();
    }

    public function  maquina($id)  {
        if($id){
            return $this->where('maquina_id', $id)->where('status_ordem_id','1')->get();
        }else{

            return $this->where('status_ordem_id','1')->get();
        }


    }

}
