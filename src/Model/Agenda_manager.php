<?php

// TODO : comments

/****************************************************************************************
 * 																						*
 * 										Agenda_manager									*
 * 																						*
 * 																						*
 * 																						*
 ****************************************************************************************/

// Includes required for the following class
use Sabre\VObject;
require_once 'src/libs/composer/vendor/autoload.php';
require_once 'src/Model/Agenda_day.php';

// Agenda_manager class
class Agenda_manager
{	

	/********************************************************************************
	 * 							UTILITIES											*
	 * 								Private functions used by the public ones		*
	 ********************************************************************************/

	/* get_raw_agenda : Get the unistra agenda corresponding to the given number.
	 * Parameter : $nagenda : The number of the agenda to get.
	 * Return : Agenda on ical format. Need to be transform into an array to be used.
	 */
	private static function get_raw_agenda($nagenda)
	{
		// Get data from ical url
		$calendarData = file_get_contents("https://adecons.unistra.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=" . $nagenda ."&projectId=1&calType=ical&nbWeeks=4");
		// Parse calendar
		$calendar = VObject\Reader::read($calendarData);

		return $calendar;
	}
		
	/* sort_date : Sort the events of an ical agenda by their date.
	 * Parameter : $calendar : Ical agenda to sort.
	 * Return : Sorted agenda on ical format. Need to be transform into an array to be used.
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

	/* transform_into_array : Transforms an ical agenda into a dictionary.
	 * 					Only save the first and the last event data for each day.
	 * Parameter : $calendar : Ical agenda to transform.
	 * Return : Dictionary of Agenda_day, with the date as the key.
	 */
	private static function transform_into_array($calendar)
	{
		$timezone = new \DateTimeZone('Europe/Paris');
        $calendarArray = array();

        foreach ($calendar as $event)
		{
			// Extract date time of the event
            $startDate = (new \DateTime((string)$event->DTSTART))->setTimezone($timezone);
            $endDate = (new \DateTime((string)$event->DTEND))->setTimezone($timezone);
            $date = $startDate->format('Y-m-d');

			// Extract place of the event
			$place = (string)$event->LOCATION;

			// Only save the first and the last event of a day into a dictionary			
            if (!isset($calendarArray[$date]))
			{
			$calendarArray[$date] = new Agenda_day($date, $startDate, $endDate, $place/*, $place*/);
            }
			else
			{
                if ($startDate < $calendarArray[$date]->__get_start_time())
				{
                    $calendarArray[$date]->__set_start_time($startDate);
					$calendarArray[$date]->__set('start_place', $place);
                }
                if ($endDate > $calendarArray[$date]->__get_end_time())
				{
					$calendarArray[$date]->__set_end_time($endDate);
					$calendarArray[$date]->__set('end_place', $place);
                }
            }
        }

		return $calendarArray;
	}

	private static function transform_place_array($calendar)
	{
		$calendarArray = array();

		foreach($calendar as $event)
		{
			$places = explode(',', (string) $event->LOCATION);
			foreach($places as $place)
			{
				$calendarArray[] = $place;
			}			
		}

		// Only keep unique values
		$calendar_array = array_unique($calendarArray/*, SORT_STRING*/);

		// Update array indexes
		$calendar_array = array_values($calendar_array);
		
		return $calendar_array;
	}

	/************************************************************************************
	 * 							PUBLIC FUNCTIONS										*
	 * 								Public functions to access data related to agendas	*
	 ************************************************************************************/


	/* get_full_agenda : Get the unistra agenda corresponding to the given number.
	 * Parameter : The number of the agenda to get.
	 * Return : Dictionary of Agenda_day, with the date as the key.
	 */ 
	public static function get_full_agenda($nagenda)
	{
		$calendar = Agenda_manager::get_raw_agenda($nagenda);
		$calendar_sorted = Agenda_manager::sort_date($calendar);
		$calendar_array = Agenda_manager::transform_into_array($calendar_sorted);

		return $calendar_array;	
	}

	public static function get_place_agenda($nagenda)
	{
		$calendar = Agenda_manager::get_raw_agenda($nagenda);
		$calendar_sorted = Agenda_manager::sort_date($calendar);
		$calendar_array = Agenda_manager::transform_place_array($calendar_sorted);

		return $calendar_array;	
	}

	/* filter_date : Extract a specific period of the given agenda.
	 * Parameters : - $agenda_array   : Dictionary of Agenda_day, with the date as the key, to filter.
	 * 				- $start_date 	  : Date of the beginning of the filter.
	 * 				- $number_of_days : Size in days of the filter.
	 * Return : Dictionary of Agenda_day, with the date as the key, containing data of the given number
	 * 			of days, starting from the given start date.
	 */ 
	public static function filter_date($agenda_array, $start_date, $number_of_days)
	{
		$agenda_filtered = array();

		// Calculates end date
		$end_date = clone $start_date;
		$end_date->modify("+{$number_of_days} days");

		// Format start and end dates
		$end_date = $end_date->format('Y-m-d');
		$start_date = $start_date->format('Y-m-d');

		// filter data according to its date
		foreach($agenda_array as $event)
		{
			// TODO : handle different timezones
			if( $event->__get_date() >= $start_date
					&& $event->__get_date() < $end_date )
			{
				$agenda_filtered[] = $event;
			}
		}

		return $agenda_filtered;
	}

}
