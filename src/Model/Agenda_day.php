<?php
/**
 * TODO Auto-generated comment.
 */
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
	

	public function __get_date()
	{
		return $this->_date;
	}

	public function __get_start_time()
	{
		return $this->_start_time;
	}

	public function __get_end_time()
	{
		return $this->_end_time;
	}

	public function __set_start_time($new_start_time)
	{
		$this->_start_time = $new_start_time;
	}

	public function __set_end_time($new_end_time)
	{
		$this->_end_time = $new_end_time;
	}

	// TODO : add some comments
	// TODO : retourner un seuil de compatibilité en fonction du temps de différence entre les 2 horaires
	private function compare_time($this_time_to_compare, $time_to_compare)
	{
		$datetime1 = new DateTime($this_time_to_compare);
		$datetime2 = new DateTime($time_to_compare);

		$interval = $datetime1->diff($datetime2);
		$interval_hours = $interval->h; 
		
		if ($interval_hours <= 2) {
			return true; //compatibles
		}
		return false; //non-compatibles

		/*if( ($time_to_compare <= Agenda_day::$_middle_of_the_day && $this_time_to_compare <= Agenda_day::$_middle_of_the_day)
			|| ($time_to_compare >= Agenda_day::$_middle_of_the_day && $this_time_to_compare >= Agenda_day::$_middle_of_the_day) )
		{
			return true;
		}
		return false;*/
	}

	public function compare_start_time($agenda_day)
	{
		return $this->compare_time(($this->__get_start_time())->format('H:i'),
									($agenda_day->__get_start_time())->format('H:i'));
	}

	public function compare_end_time($agenda_day)
	{
		return $this->compare_time(($this->__get_end_time())->format('H:i'),
									($agenda_day->__get_end_time())->format('H:i'));
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

	public function compare_start_place($agenda_day)
	{
		return Agenda_day::compare_place($this->__get('start_place'), $agenda_day->__get('start_place'));
	}

	public function compare_end_place($agenda_day)
	{
		return Agenda_day::compare_place($this->__get('end_place'), $agenda_day->__get('end_place'));
	}
}

?>

