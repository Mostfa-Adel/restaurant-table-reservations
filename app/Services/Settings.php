<?php

namespace App\Services;

class Settings
{
    private static $minReservationMinutes= 30;
    private static $maxSeatsPerTable= 12;
    private static $workStartTime= '12:00';
    private static $workEndTime= '23:59';
    // available reservation time start after {syncMinutes} 
    private static $syncMinutes= 2;


    public static function getMinReservationMinutes()
    {
        return self::$minReservationMinutes;
    }

    public static function getMaxSeatsPerTable()
    {
        return self::$maxSeatsPerTable;
    }

    public static function getWorkStartTime()
    {
        return self::$workStartTime;
    }
    
    public static function getWorkEndTime()
    {
        return self::$workEndTime;
    }
    
    public static function getSyncMinutes()
    {
        return self::$syncMinutes;
    }

    public function extractHour($timeString, $format ="H:i")
    {
        $dt = \DateTime::createFromFormat($format, $timeString);
        $hours = $dt->format('H');
        return $hours;
    }

}
