<?php

namespace App\Http\Controllers\Api;

use App\Servers\Services\ServerService;
use Illuminate\Http\Request;

class ServerController
{
    /**
     * Return list
     * @return JSON
     */
    public function list()
    {
        return (new ServerService())->getList();
    }

    /**
     * Add new item
     * @return JSON
     */
    public function add(Request $request)
    {
        return (new ServerService())->add($request);
    }

    /**
     * Delete item
     * @return JSON
     */
    public function delete(Request $request)
    {
        return (new ServerService())->delete($request);
    }
}
