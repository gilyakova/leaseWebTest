<?php
namespace App\Modules\Models;

use Illuminate\Database\Eloquent\Model;

/**
 */
class Module extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'server_id', 'type', 'size',
    ];
}
