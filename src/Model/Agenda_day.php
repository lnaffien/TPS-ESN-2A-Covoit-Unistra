<?php
/**
 * TODO Auto-generated comment.
 */
// TODO : énumération remplie à partir d'un .ini
/*
enum Suit: string
{
    case Hearts = 'H';
    case Diamonds = 'D';
    case Clubs = 'C';
    case Spades = 'S';
}*/
define("_NAGENDA_IUT_HAG", 30606);
define("_NAGENDA_ILLKIRCH", 301);

class Agenda_day
{
	private $_date;
	private $_start_time;
	private $_end_time;
	private $_start_place;
	private $_end_place;

	public function __construct($date, $start_time, $end_time, $start_place)
	{
		$this->_date = $date;
		$this->_start_time = $start_time;
		$this->_end_time = $end_time;
		$this->_start_place = $start_place;
	}
/*
	public function __construct($date, $start_time, $end_time, $start_place, $end_place)
	{
		$this->_date = $date;
		$this->_start_time = $start_time;
		$this->_end_time = $end_time;
		$this->_start_place = $start_place;
		$this->_end_place = $end_place;
	}
*/
	public function __get($property)
    {
        switch($property)
        {
			case 'date' :
				return $this->_date;
				break;
			case 'start_time' :
				return $this->_start_time;
				break;
			case 'end_time' :
				return $this->_end_time;
				break;
			case 'start_place' :
				return $this->_start_place;
				break;
			case 'end_place' :
				return $this->_end_place;
				break;
			default:
				throw new Exception("User : __get : Invalid Property {$property}");
		}
	}

	public function __set($property, $value)
    {
        switch($property)
        {
			case 'date' :
				$this->_date = $value;
				break;
			case 'start_time' :
				$this->_start_time = $value;
				break;
			case 'end_time' :
				$this->_end_time = $value;
				break;
			case 'start_place' :
				$this->_start_place = $value;
				break;
			case 'end_place' :
				$this->_end_place = $value;
				break;
			default:
				throw new Exception("User : __get : Invalid Property {$property}");
		}
	}

	// TODO : add some comments
	private static function compare_time($this_time_to_compare, $time_to_compare)
	{
		$datetime1 = new DateTime($this_time_to_compare);
		$datetime2 = new DateTime($time_to_compare);

		// Calculates the interval in hour between the given times
		$interval = $datetime1->diff($datetime2);
		$interval_hours = $interval->h; 

		switch($interval_hours)
		{
			case 0 :
				return 100;
				break;
			case $interval_hours <= 2 :
				return 75;
				break;
			case $interval_hours <= 4 :
				return 50;
				break;
			case $interval_hours <= 6 :
				return 25;
				break;			
		}
		return 0;
	}

	private static function same_location($places_array, $this_place_to_compare, $place_to_compare)
	{
		$this_place_location = false;
		$place_location_to_compare = false;

		foreach($places_array as $place)
		{
			if($place == $this_place_to_compare)
			{
				$this_place_location = true;
			}
			if($place == $place_to_compare)
			{
				$place_location_to_compare = true;
			}
		}
		return $this_place_location && $place_location_to_compare;
	}

	private static function compare_place($this_place_to_compare, $place_to_compare)
	{
		$this_place_location = false;
		$place_location_to_compare = false;

		// If the places are the same
		if($this_place_to_compare == $place_to_compare)
		{
			return true;
		}

		// If the places are both at the Haguenau IUT
		$iut_hag_places = Agenda_manager::get_place_agenda(_NAGENDA_IUT_HAG);
		if(Agenda_day::same_location($iut_hag_places, $this_place_to_compare, $place_to_compare))
		{
			return true;
		}		

		// If the places are both at the Illkirch campus
		$illkirch_places = Agenda_manager::get_place_agenda(_NAGENDA_ILLKIRCH);
		if(Agenda_day::same_location($illkirch_places, $this_place_to_compare, $place_to_compare))
		{
			return true;
		}	

		return false;
	}

	public function compare_start_time_and_place($agenda_day)
	{
		if(! Agenda_day::compare_place($this->__get('start_place'), $agenda_day->__get('start_place')) )
		{
			return -1;
		}

		return Agenda_day::compare_time(($this->__get_start_time())->format('H:i'),
									($agenda_day->__get_start_time())->format('H:i'));
	}

	public function compare_end_time_and_place($agenda_day)
	{
		if(! Agenda_day::compare_place($this->__get('end_place'), $agenda_day->__get('end_place')) )
		{
			return -1;
		}

		return Agenda_day::compare_time(($this->__get_end_time())->format('H:i'),
									($agenda_day->__get_end_time())->format('H:i'));
	}

}

?>

