<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    protected $fillable = [
        'number_of_seats',
        'table_number',
    
    ];


    /**
     * Get the 
     *
     * @return string
     */
    public function getTableDescriptionAttribute()
    {
        return "Table Number ". $this->table_number . " (".$this->number_of_seats ." Seats)";
    }
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/restaurant-tables/'.$this->getKey());
    }

    /**
     * Get all of the reservations for the RestaurantTable
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations()
    {
        return $this->hasMany(RestaurantTableReservation::class, 'restaurant_table_id', 'id');
    }
}
