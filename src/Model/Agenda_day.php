<?php
/**
 * TODO Auto-generated comment.
 */
class Agenda_day
{
	private $_date;
	private $_start_time;
	private $_end_time;
	private static $_middle_of_the_day;

	public function __construct($date, $start_time, $end_time)
	{
		Agenda_day::$_middle_of_the_day = (new \DateTime(date("H:i:s", strtotime('12PM'))))->setTimezone(new \DateTimeZone('Europe/Paris'))->format('H:i');
		$this->_date = $date;
		$this->_start_time = $start_time;
		$this->_end_time = $end_time;
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
		if( ($time_to_compare <= Agenda_day::$_middle_of_the_day && $this_time_to_compare <= Agenda_day::$_middle_of_the_day)
			|| ($time_to_compare >= Agenda_day::$_middle_of_the_day && $this_time_to_compare >= Agenda_day::$_middle_of_the_day) )
		{
			return true;
		}
		return false;		
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

