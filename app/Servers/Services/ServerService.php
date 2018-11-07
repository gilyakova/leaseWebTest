<?php
namespace App\Servers\Services;

use Illuminate\Http\Request;
use App\Servers\Models\Server;
use App\Servers\Resources\ServerResource;

/*
 */
class ServerService
{
    /**
     *
     */
    public function getList()
    {
        $user = auth()->guard('api')->user();
        $list = Server::where('user_id', $user->id)->get();
        return ($list) ? ServerResource::collection($list) : [];
    }
}