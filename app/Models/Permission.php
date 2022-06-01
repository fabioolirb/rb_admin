<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * Class Permission
 * @package App\Models
 * @version July 23, 2021, 4:50 pm UTC
 *
 * @property string $name
 * @property string $title
 * @property string $guard_name
 * @property string $description
 * @property string $module
 */
class Permission extends Model
{
    use SoftDeletes,LogsActivity;


    public $table = 'permissions';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'title',
        'guard_name',
        'description',
        'module'
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
        'name' => 'string',
        'title' => 'string',
        'guard_name' => 'string',
        'module' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:255|unique:permissions,name'
    ];
}
