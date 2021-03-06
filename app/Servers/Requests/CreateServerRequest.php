<?php
namespace App\Servers\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 */
class CreateServerRequest extends FormRequest
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
            'assetId' => 'required|integer|unique:servers,asset_id',
            'brand' => 'required|max:100',
            'name' => 'required|max:100',
            'price' => 'required|numeric|min:1'
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
            'assetId' => 'trim',
            'brand' => 'trim',
            'name' => 'trim',
            'price' => 'trim'
        ];
    }
}
