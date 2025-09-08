<?php

namespace App\Constants;

class CacheLifetime
{
    const ONE_MINUTE = 60;
    const FIVE_MINUTES = 60 * 5;
    const TEN_MINUTES = 60 * 10;

    const ONE_HOUR = 3600;
    const TWO_HOURS = 3600 * 2;

    const HALF_DAY = 3600 * 12;
    const ONE_DAY = 3600 * 24;
    const SEVEN_DAYS = 3600 * 24 * 7;
}