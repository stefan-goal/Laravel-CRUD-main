<?php

namespace App\Http\Requests\Store\Location;

use App\Models\Store\Location\Location;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LocationUpdateRequest
 * @package App\Http\Requests\Store\Location
 */
class LocationUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if ($this->user()->cannot('create', Location::class)) {
            return false;
        }

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
            'shopper_limit' => 'required|integer|max:100'
        ];
    }
}
