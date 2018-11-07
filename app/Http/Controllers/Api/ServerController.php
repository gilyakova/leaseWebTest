<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Servers\Services\ServerService;
use Illuminate\Http\Request;

class ServerController
{

    /**
     * Return list of servers
     * @return array
     */
    public function list()
    {
        return (new ServerService())->getList();
    }

}

