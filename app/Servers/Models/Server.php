<?php
namespace App\Servers\Models;

use Illuminate\Database\Eloquent\Model;

/**
 */
class Server extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'asset_id', 'brand', 'name', 'price', 'valid'
    ];
}
