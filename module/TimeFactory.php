<?php
class TimeFactory extends DateTime {
	public function setTimestamp($timestamp) {
		$date = getdate(( int ) $timestamp);
		$this->setDate($date['year'], $date['mon'], $date['mday']);
		$this->setTime($date['hours'], $date['minutes'], $date['seconds']);
	}

	public function getTimestamp() {
		return $this->format('U');
	}
}