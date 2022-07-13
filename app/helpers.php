<?php

use Illuminate\Support\Carbon;

function formatTimezone($dateTimeField)
{
    if (!empty($dateTimeField)) {
        return !empty(auth()->user()->timezone) ?
        Carbon::createFromFormat('Y-m-d H:i:s', $dateTimeField, 'UTC')->setTimezone(auth()->user()->timezone)
            : Carbon::createFromFormat('Y-m-d H:i:s', $dateTimeField, 'UTC')->setTimezone(geoip()->getLocation(request()->ip()));
    }
}

function generateTempPasscode($length=5)
{
    return substr(str_shuffle('0123456789!@#$%^&ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
}
