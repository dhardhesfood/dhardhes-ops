<?php

namespace App\Services;

class AttendanceCalculator
{
    public static function calculate($checkIn, $checkOut, $dailySalary, $extraJobSalary, $mealAllowance)
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
        $overtimeRounded = self::roundMinutes($overtimeMinutes);
        $lateRounded = self::roundMinutes($lateMinutes);

        // konversi ke jam
        $overtimeDecimal = $overtimeRounded / 60;
        $lateDecimal = $lateRounded / 60;

        // hitung uang
        $overtimeMoney = $overtimeDecimal * 6000;
        $lateMoney = $lateDecimal * 4000;

        $extraJob = $extraJobSalary;
        $meal = $mealAllowance;

        if ($workMinutes == 0) {
        $extraJob = 0;
        $meal = 0;
    }

        $dailyTotal = intval(
        $dailySalary
        + $extraJob
        + $meal
        + $overtimeMoney
        - $lateMoney
    );

        return [

    'work_minutes' => $workMinutes,

    'overtime_minutes' => $overtimeRounded,
    'late_minutes' => $lateRounded,

    'overtime_decimal' => $overtimeDecimal,
    'late_decimal' => $lateDecimal,

    'overtime_money' => $overtimeMoney,
    'late_money' => $lateMoney,

    'daily_total' => $dailyTotal
];
    }

    private static function roundMinutes($minutes)
{

    if ($minutes <= 9) {
        return 0;
    }

    if ($minutes <= 20) {
        return 15;
    }

    if ($minutes <= 39) {
        return 30;
    }

    if ($minutes <= 49) {
        return 45;
    }

    return 60;

}

}