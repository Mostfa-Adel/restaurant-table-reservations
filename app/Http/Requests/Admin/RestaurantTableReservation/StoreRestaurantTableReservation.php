<?php

namespace App\Http\Requests\Admin\RestaurantTableReservation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreRestaurantTableReservation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.restaurant-table-reservation.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'reservation_date' => ['required', 'date'],
            'reservation_start_time' => ['required', 'date_format:H:i:s'],
            'reservation_end_time' => ['required', 'date_format:H:i:s'],
            'created_by' => ['required', 'string'],
            'restaurant_table_id' => ['required', 'string'],
            
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
