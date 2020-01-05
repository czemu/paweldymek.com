<?php

namespace App\Helpers;

class Date
{
    const YEAR   = 31556926;
    const MONTH  = 2629744;
    const WEEK   = 604800;
    const DAY    = 86400;
    const HOUR   = 3600;
    const MINUTE = 60;

    public static function humanize($date)
    {
        $timestamp = strtotime($date);
        $offset = time() - $timestamp;

        if ($offset < Date::MINUTE)
        {
            $date = $offset.' sek.';
        }
        elseif ($offset < Date::HOUR)
        {
            $date = Date::span($timestamp, null, 'minutes').' min.';
        }
        elseif ($offset < Date::DAY)
        {
            $date = Date::span($timestamp, null, 'hours').' godz.';
        }
        elseif ($offset < Date::WEEK)
        {
            $arr = Date::span($timestamp, null, 'days,hours');

            if ($arr['days'] == 1)
            {
                $date = '1 dzień';

                if ($arr['hours'] > 0)
                    $date .= ', ' . $arr['hours'].' godz.';
            }
            else
            {
                $date = $arr['days'] . ' dni';
            }
        }
        elseif ($offset < Date::MONTH)
        {
            $date = Date::span($timestamp, null, 'weeks').' tyg.';
        }
        elseif ($offset < Date::YEAR)
        {
            $date = Date::span($timestamp, null, 'months').' mies.';
        }
        elseif ($offset >= Date::YEAR)
        {
            $years = Date::span($timestamp, null, 'years');

            if ($years == 1)
                $date = '1 rok';
            elseif ($years == 2 OR $years == 3 OR $years == 4)
                $date = $years.' lata';
            else
                $date = $years.' lat';
        }
        else
        {
            $date = 'dawno';
        }

        return $date.' temu';
    }

    /**
	 * Returns time difference between two timestamps, in human readable format.
	 * If the second timestamp is not given, the current time will be used.
	 * Also consider using [Date::fuzzy_span] when displaying a span.
	 *
	 *     $span = Date::span(60, 182, 'minutes,seconds'); // array('minutes' => 2, 'seconds' => 2)
	 *     $span = Date::span(60, 182, 'minutes'); // 2

     * @author     Kohana Team
     * @copyright  (c) Kohana Team
     * @license    https://koseven.ga/LICENSE.md
	 *
	 * @param   integer $remote timestamp to find the span of
	 * @param   integer $local  timestamp to use as the baseline
	 * @param   string  $output formatting string
	 * @return  string   when only a single output is requested
	 * @return  array    associative list of all outputs requested
	 */
	public static function span($remote, $local = NULL, $output = 'years,months,weeks,days,hours,minutes,seconds')
	{
		// Normalize output
		$output = trim(strtolower( (string) $output));

		if ( ! $output)
		{
			// Invalid output
			return FALSE;
		}

		// Array with the output formats
		$output = preg_split('/[^a-z]+/', $output);

		// Convert the list of outputs to an associative array
		$output = array_combine($output, array_fill(0, count($output), 0));

		// Make the output values into keys
		extract(array_flip($output), EXTR_SKIP);

		if ($local === NULL)
		{
			// Calculate the span from the current time
			$local = time();
		}

		// Calculate timespan (seconds)
		$timespan = abs($remote - $local);

		if (isset($output['years']))
		{
			$timespan -= Date::YEAR * ($output['years'] = (int) floor($timespan / Date::YEAR));
		}

		if (isset($output['months']))
		{
			$timespan -= Date::MONTH * ($output['months'] = (int) floor($timespan / Date::MONTH));
		}

		if (isset($output['weeks']))
		{
			$timespan -= Date::WEEK * ($output['weeks'] = (int) floor($timespan / Date::WEEK));
		}

		if (isset($output['days']))
		{
			$timespan -= Date::DAY * ($output['days'] = (int) floor($timespan / Date::DAY));
		}

		if (isset($output['hours']))
		{
			$timespan -= Date::HOUR * ($output['hours'] = (int) floor($timespan / Date::HOUR));
		}

		if (isset($output['minutes']))
		{
			$timespan -= Date::MINUTE * ($output['minutes'] = (int) floor($timespan / Date::MINUTE));
		}

		// Seconds ago, 1
		if (isset($output['seconds']))
		{
			$output['seconds'] = $timespan;
		}

		if (count($output) === 1)
		{
			// Only a single output was requested, return it
			return array_pop($output);
		}

		// Return array
		return $output;
	}
}
