<?php

namespace App\Http\Controllers\Api;

use App\Modules\Services\ModuleService;
use Illuminate\Http\Request;

class ModuleController
{
    /**
     * Add new item
     * @return array
     */
    public function add(Request $request)
    {
        return (new ModuleService())->add($request);
    }

    /**
     * List of types
     * @return array
     */
    public function types()
    {
    	return ModuleService::types();
    }
}

