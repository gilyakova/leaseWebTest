<?php
namespace App\Modules\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'server_id' => 'required|integer|exists:servers,id',
            'type' => 'required|in:DDR,DDR2,DDR3,DDR4,SDR,SDRAM,SRAM', // better way to use another table and validation "exists"
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
            'server_id' => 'trim',
            'type' => 'trim',
            'size' => 'trim'
        ];
    }

}