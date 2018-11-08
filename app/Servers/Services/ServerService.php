<?php
namespace App\Servers\Services;

use Illuminate\Http\Request;
use App\Servers\Models\Server;
use App\Servers\Resources\ServerResource;
use App\Servers\Requests\CreateServerRequest;
use Illuminate\Http\Response;
use Validator;

/*
 */
class ServerService
{
    /**
     * Get list
     * @return JSON
     */
    public function getList()
    {
        $user = auth()->guard('api')->user();
        $list = Server::where('user_id', $user->id)
                    ->where('deleted', '0')
                    ->orderBy('asset_id')
                    ->paginate(5);
        return ($list) ? ServerResource::collection($list) : [];
    }

    /**
     * Insert new record
     * @param Request $request
     * @return JSON
     */
    public function add(Request $request)
    {
        $user = auth()->guard('api')->user();
        $rules = (new CreateServerRequest())->rules();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }
        $item = Server::create([
            'user_id' => $user->id,
            'asset_id' => $request->assetId,
            'brand' => $request->brand,
            'name' => $request->name,
            'price' => $request->price
        ]);
        if (!$item) {
            return response()->json(['errors' => ['DB error']], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(['id' => $item->id, ], Response::HTTP_CREATED);
    }

    /**
     * Update validation of server
     * @param int $serverId
     * @return boolean
     */
    public function updateValidation($serverId)
    {
        $item = Server::find($serverId);
        if (!$item) {
            return false;
        }
        $modulesValid = count($item->modules) > 0;
        $result = true;
        if ((bool)$item->valid != $modulesValid) {
            $result = $item->update(['valid' => $modulesValid]);
        }
        var_dump($result);die();
        return $result;
    }
}
