<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


/**
 * Class status_montagem
 * @package App\Models
 * @version March 15, 2022, 3:16 pm -03
 *
 * @property string $nome
 */
class status_montagem extends Model
{
    use SoftDeletes,LogsActivity;


    public $table = 'status_montagems';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nome'
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
        'nome' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
