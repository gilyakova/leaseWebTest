<?php
namespace App\Modules\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Models\Module;

/**
 */
class CreateModuleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'serverId' => 'required|integer|exists:servers,id',
            'type' => 'required|in:'.implode(',', Module::TYPES), // better way to use another table and validation "exists"
            'size' => 'required|integer|min:1'
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'serverId' => 'trim',
            'type' => 'trim',
            'size' => 'trim'
        ];
    }

}