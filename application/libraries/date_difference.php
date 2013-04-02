<?php
class date_difference {
	public $date1, $date2, $a, $days, $hours, $minutes, $seconds;

	function calculate($date_, $date__) {
		$this -> date1 = $date_;
		$this -> date2 = $date__;
		$this -> days = intval((strtotime($this -> date1) - strtotime($this -> date2)) / 86400);
		$this -> a = ((strtotime($this -> date1) - strtotime($this -> date2))) % 86400;
		$this -> hours = intval(($this -> a) / 3600);
		$this -> a = ($this -> a) % 3600;
		$this -> minutes = intval(($this -> a) / 60);
		$this -> a = ($this -> a) % 60;
		$this -> seconds = $this -> a;
	}
}
?>