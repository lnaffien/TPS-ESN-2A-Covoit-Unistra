<?php

use Sabre\VObject;
require_once 'src/libs/composer/vendor/autoload.php';

/**
 * TODO Auto-generated comment.
 */
class Agenda_manager
{
	/**
	 * TODO Auto-generated comment.
	 */
	private static function get_raw_agenda($nagenda)
	{
		// Get data from ical url
		$calendarData = file_get_contents("https://adecons.unistra.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=" . $nagenda ."&projectId=1&calType=ical&nbWeeks=4");
		// Parse calendar
		$calendar = VObject\Reader::read($calendarData);

		return $calendar;
	}

	public static function get_full_agenda($nagenda)
	{
		$calendar = Agenda_manager::get_raw_agenda($nagenda);
		$calendar_sorted = Agenda_manager::sort_date($calendar);
		$calendar_array = Agenda_manager::transform_into_array($calendar_sorted);

		return $calendar_array;		
	}
	
	/**
	 * TODO Auto-generated comment.
	 */
	private static function sort_date($calendar)
	{
		$events = $calendar->getBaseComponents('VEVENT');
        usort($events, function($a, $b)
		{
            return $a->DTSTART->getDateTime() <=> $b->DTSTART->getDateTime();
        });

		return $events;
	}

	private static function transform_into_array($calendar)
	{
		$timezone = new \DateTimeZone('Europe/Paris');
        $calendarArray = array();

        foreach ($calendar as $event)
		{
            $startDate = (new \DateTime((string)$event->DTSTART))->setTimezone($timezone);
            $endDate = (new \DateTime((string)$event->DTEND))->setTimezone($timezone);
            $date = $startDate->format('Y-m-d');
			
            if (!isset($calendarArray[$date]))
			{
                $calendarArray[$date] = array('start' => $startDate, 'end' => $endDate);
            }
			else
			{
                if ($startDate < $calendarArray[$date]['start'])
				{
                    $calendarArray[$date]['start'] = $startDate;
                }
                if ($endDate > $calendarArray[$date]['end'])
				{
                    $calendarArray[$date]['end'] = $endDate;
                }
            }
        }

        $result = array();
        foreach ($calendarArray as $date => $times)
		{
            $result[] = array('heureDebut' => $times['start'], 'heureFin' => $times['end']);
        }
        return $result;
	}

	/**
	 * TODO Auto-generated comment.
	 */
	public static function filter_date($agenda_array, $start_date, $number_of_days)
	{
		$agenda_filtered = array();

		// Calculates end date
		$end_date = clone $start_date;
		$end_date->modify("+{$number_of_days} days");
		
		// filter data according to its date
		foreach($agenda_array as $event)
		{
			// TODO : handle different timezones
			if( $event['heureDebut']->format('Y-m-d') >= $start_date->format('Y-m-d')
					&& $event['heureDebut']->format('Y-m-d') < $end_date->format('Y-m-d'))
			{
				$agenda_filtered[] = $event;
			}
		}

		return $agenda_filtered;
	}

}
