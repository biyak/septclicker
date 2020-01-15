<?php
// This is not a model file, this contains functions I will be using across several controllers


/**
 * Gets the amount of seconds that have passed since a timestamp
 * @param $timestamp The timestamp as returned by Laravel
 * @return false|float|int The number of seconds that have passed since this timestamp, or false if the timestamp is invalid
 */
function getTimestampDifference($timestamp){
    // Laravel stores the timestamps as strings
    // Current time in GMT - Time of timestamp in GMT = seconds passed
    return time() - strtotime($timestamp);
}
