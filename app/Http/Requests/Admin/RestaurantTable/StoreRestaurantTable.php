<?php

namespace App\Http\Requests\Admin\RestaurantTable;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreRestaurantTable extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.restaurant-table.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'number_of_seats' => ['required', 'integer','min:1', 'max:'.\App\Services\Settings::getMaxSeatsPerTable()],
            'table_number' => ['required', 'integer', Rule::unique('restaurant_tables', 'table_number')],
            
        ];
    }

    /**
    * Modify input data
    *
    * @return array
    */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();

        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
