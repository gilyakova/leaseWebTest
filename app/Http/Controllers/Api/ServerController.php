<?php

namespace App\Http\Controllers\Api;

use App\Servers\Services\ServerService;
use Illuminate\Http\Request;

class ServerController
{
    /**
     * Return list
     * @return array
     */
    public function list()
    {
        return (new ServerService())->getList();
    }

    /**
     * Add new item
     * @return array
     */
    public function add(Request $request)
    {
        return (new ServerService())->add($request);
    }
}
