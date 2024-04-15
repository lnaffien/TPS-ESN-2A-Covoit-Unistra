<?php
/**
 * TODO Auto-generated comment.
 */
class Agenda_day
{
	private $_date;
	private $_start_time;
	private $_end_time;

	public function __construct($date, $start_time, $end_time)
	{
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

	/**
	 * TODO Auto-generated comment.
	 */
	public function compare_to($agenda_day) {
		return false;
	}
}
