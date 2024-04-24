<?php
/**
 * TODO Auto-generated comment.
 */
class Agenda_day
{
	private $_date;
	private $_start_time;
	private $_end_time;
	private $_start_place;
	private $_end_place;

	// TODO : et le lieu ??
	public function __construct($date, $start_time, $end_time)
	{
		$this->_date = $date;
		$this->_start_time = $start_time;
		$this->_end_time = $end_time;
	}

	// TODO : a supprimer !
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
}

?>

