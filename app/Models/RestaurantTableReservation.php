<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantTableReservation extends Model
{
    protected $fillable = [
        'reservation_date',
        'reservation_start_time',
        'reservation_end_time',
        'created_by',
        'restaurant_table_id',
        //TODO Add these columns to migration
        'guests_count',
        'table_seats_count',
        'table_number',
        'note',
    
    ];
    
    
    protected $dates = [
        'reservation_date',
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url', 'table_description'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/restaurant-table-reservations/'.$this->getKey());
    }

    public function getTableDescriptionAttribute()
    {
        return "Table Number ". $this->table_number . " (".$this->table_seats_count ." Seats)";
    }
}
