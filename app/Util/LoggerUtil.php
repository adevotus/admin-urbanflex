<?php
namespace App\Util;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class LoggerUtil {

    private static function getChannel() {
        return Log::channel('urban-flex');
    }

    public static function error($msg) {
        LoggerUtil::getChannel()->error($msg);
    }

    public static function debug($msg) {
        LoggerUtil::getChannel()->debug($msg);
    }

    public static function info($msg) {
        LoggerUtil::getChannel()->info($msg);
    }

    public static function warning($msg) {
        LoggerUtil::getChannel()->warning($msg);
    }

}
