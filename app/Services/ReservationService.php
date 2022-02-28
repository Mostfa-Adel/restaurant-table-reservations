<?php

namespace App\Services;

use App\Models\RestaurantTable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ReservationService
{

    public static function minRequiredSeats($requiredSeats)
    {
        $min = DB::table('restaurant_tables')
            ->select(DB::raw("min(number_of_seats) m"))
            ->where('number_of_seats', '>=', $requiredSeats)
            ->first();
        return $min->m;

    }

    public static function tableAvailableTimeSlots($startTime, $endTime, Collection $dayReservationsCollection,RestaurantTable $tableDeatails)
    {
        $minReservationMinutes = Settings::getMinReservationMinutes();
        $reservationsCount=$dayReservationsCollection->count();

        $currentStartTime = $startTime;
        if (! $reservationsCount) {
            $availableTimeSlots[] = [
                'table_id'=>$tableDeatails->id,
                'table_description'=>$tableDeatails->table_description,
                'start' => $startTime,
                'end' => $endTime
            ];
            return $availableTimeSlots;
        }

        $sortedReservations = $dayReservationsCollection->sortBy('reservation_start_time');
        $currentEndTime = $sortedReservations[0]->reservation_start_time;
        for ($i = 0; $i <= $reservationsCount; $i++) {
            $availableMinutes = (strtotime($currentEndTime) - strtotime($currentStartTime)) / 60;
            if ($availableMinutes >= $minReservationMinutes) {
                $availableTimeSlots[] = [
                    'table_id'=>$tableDeatails->id,
                    'table_description'=>$tableDeatails->table_description,
                    'start' => $currentStartTime,
                    'end' => $currentEndTime
                ];
            }
            if ($i<$reservationsCount) {
                $currentStartTime=$sortedReservations[$i]->reservation_end_time;
                
                if ($i!=$reservationsCount-1) {
                    $currentEndTime=$sortedReservations[$i+1]->reservation_start_time;
                }else{
                    $currentEndTime=$endTime;
                }
            }
            
        }
        return $availableTimeSlots;
    }

    public function getFirstReservationTimeFromNow()
    {
        $startWorkingTime=Settings::getWorkStartTime();
        $nowTime= self::addMinutesToTime(date('H:i:s'), Settings::getSyncMinutes());
        if ($nowTime<$startWorkingTime) {
            return $startWorkingTime;
        }
        return $nowTime;
        
    }

    public static function addMinutesToTime($time, $minutes=0, $format="H:i")
    {
        $time = strtotime($time);
        $resultTime = date($format, strtotime("+".$minutes.' minutes', $time));
        return $resultTime;
    } 
}
