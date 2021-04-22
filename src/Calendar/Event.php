<?php

namespace Calendar;

class Event {

	private $id;

	private $name;

	private $description;

	private $date_start;

	private $date_end;

	public function getId(): int {
		return $this->id;
	}

	public function getName(): string {
		return $this->name;
	}

	public function getDescription(): string {
		return $this->description ?? '';
	}

	public function getStart(): \DateTime {
		return new \DateTime($this->date_start);
	}

	public function getEnd(): \DateTime {
		return new \DateTime($this->date_end);
	}

	public function setName(string $name) {
		$this->name = $name;
	}

	public function setDescription(string $description) {
		$this->description = $description;
	}

	public function setStart(string $date_start) {
		$this->date_start = $date_start;
	}

	public function setEnd(string $date_end) {
		$this->date_end = $date_end;
	}

}

?>