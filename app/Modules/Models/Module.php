<?php
namespace App\Modules\Models;

use Illuminate\Database\Eloquent\Model;

/**
 */
class Module extends Model
{
    /**
     * List of types.
     *
     * @var array
     */
    const TYPES = [
        'DDR', 'DDR2', 'DDR3', 'DDR4', 'SDR', 'SDRAM', 'SRAM'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'server_id', 'type', 'size',
    ];
}
