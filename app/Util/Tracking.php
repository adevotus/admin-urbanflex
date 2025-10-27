<?php

namespace App\Util;

class Tracking
{
    // Constants for tracking percentage values
    public const PERCENT_20 = 20;
    public const PERCENT_70 = 70;
    public const PERCENT_100 = 100;

    /**
     * Get all tracking percentages.
     *
     * @return array
     */
    public static function getAllTrackingPercentages(): array
    {
        return [
            self::PERCENT_20,
            self::PERCENT_70,
            self::PERCENT_100,
        ];
    }
}
