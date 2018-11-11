<?php
namespace App\Modules\Services;

use Illuminate\Http\Request;
use App\Modules\Models\Module;
use App\Modules\Requests\CreateModuleRequest;
use Illuminate\Http\Response;
use Validator;
use App\Servers\Services\ServerService;

/*
 */
class ModuleService
{
    /**
     * Insert new record
     * @param Request $request
     * @return JSON
     */
    public function add(Request $request)
    {
        $rules = (new CreateModuleRequest())->rules();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }
        $item = Module::create([
            'server_id' => $request->serverId,
            'type' => $request->type,
            'size' => $request->size
        ]);
        if (!$item) {
            return response()->json(['errors' => ['DB error']], Response::HTTP_BAD_REQUEST);
        }
        (new ServerService())->updateValidation($request->serverId);
        return response()->json(['id' => $item->id, ], Response::HTTP_CREATED);
    }

    /**
     * Delete record
     * @param Request $request
     * @return JSON
     */
    public function delete(Request $request)
    {
        $item = Module::find($request->route('moduleId'));
        if (!$item) {
            return response()->json(['errors' => ['Record not found']], Response::HTTP_BAD_REQUEST);
        }
        if ($item->update(['deleted' => 1]) != true) {
            return response()->json(['errors' => ['DB error']], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(null, Response::HTTP_OK);
    }

    /**
     * List of types
     * @return JSON
     */
    static function types()
    {
        return response()->json(['data' => Module::TYPES]);
    }

    /**
     * List of types
     * @return integer count of affected rows
     */
    public function deleteByServer($serverId)
    {
        return Module::where('server_id', $serverId)->update(['deleted' => 1]);
    }
}
