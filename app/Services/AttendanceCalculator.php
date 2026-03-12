<?php

namespace App\Services;

class AttendanceCalculator
{
    public static function calculate($checkIn, $checkOut, $dailySalary)
    {

        $checkInTime = strtotime($checkIn);
        $checkOutTime = strtotime($checkOut);

        $workMinutes = intval(($checkOutTime - $checkInTime) / 60);

        $standardMinutes = 480;

        $overtimeMinutes = 0;
        $lateMinutes = 0;

        if ($workMinutes > $standardMinutes) {

            $overtimeMinutes = $workMinutes - $standardMinutes;

        } elseif ($workMinutes < $standardMinutes) {

            $lateMinutes = $standardMinutes - $workMinutes;

        }

        // pembulatan 15 menit
        $overtimeRounded = round($overtimeMinutes / 15) * 15;
        $lateRounded = round($lateMinutes / 15) * 15;

        // konversi ke jam
        $overtimeDecimal = $overtimeRounded / 60;
        $lateDecimal = $lateRounded / 60;

        // hitung uang
        $overtimeMoney = $overtimeDecimal * 6000;
        $lateMoney = $lateDecimal * 4000;

        $dailyTotal = intval($dailySalary + $overtimeMoney - $lateMoney);

        return [

            'work_minutes' => $workMinutes,

            'overtime_minutes' => $overtimeRounded,
            'late_minutes' => $lateRounded,

            'overtime_decimal' => $overtimeDecimal,
            'late_decimal' => $lateDecimal,

            'daily_total' => $dailyTotal

        ];
    }
}