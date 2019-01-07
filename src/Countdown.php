<?php
/**
 * Describes the basic countdown class.
 * 
 * @package nuffy/cli-countdown
 */
namespace nuffy\cliCountdown;

use Carbon\Carbon;
use Carbon\CarbonInterval;

/**
 * CLI Countdown.
 * 
 * Countdown framework.
 * @package nuffy/cli-countdown
 */
class Countdown
{
    private static $last_lines = [];

    /**
     * Provides a simple countdown.
     * 
     * @param int $seconds Amount of seconds to count down.
     * @param string $descript Description of what's going to happen when the countdown ends. Should be compatible with sprintf, with %s as the carbon response.
     */
    public static function Simple(int $seconds, string $descript = 'Continuing %s')
    {
        echo self::clearLine().sprintf($descript, self::continuingIn($seconds));
        for($s = $seconds; $s > 0; $s--) {
            echo self::clearLine().sprintf($descript, self::continuingIn($s));
            sleep(1);
        }
        echo self::clearLine();
    }

    private static function continuingIn(int $seconds) : string
    {
        return Carbon::now()->addSeconds($seconds)->diffForHumans(["parts"=>4]);
    }

    private static function clearLine() : string
    {
        return "\r\033[K";
    }
}