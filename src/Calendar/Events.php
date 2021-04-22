<?php

namespace Calendar;

class Events {

	private $pdo;

	public function __construct(\PDO $pdo) {
		$this->pdo = $pdo;
	}

	public function getEventsBetween(\Datetime $start, \Datetime $end): array {
		$sql = "SELECT * FROM events WHERE date_start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}' ORDER BY date_start ASC";
		$statement = $this->pdo->query($sql);
		$results = $statement->fetchAll();
		return $results;
	}

	public function getEventsBetweenByDay(\Datetime $start, \Datetime $end): array {
		$events = $this->getEventsBetween($start, $end);
		$days = [];
		foreach ($events as $event) {
			$date = explode(' ', $event['date_start'])[0];
			if (!isset($days[$date])) {
				$days[$date] = [$event];
			} else {
				$days[$date][] = $event;
			}
		}
		return $days;
	}

	public function find(int $id): Event {
		$statement = $this->pdo->query("SELECT * FROM events WHERE id = $id LIMIT 1 ");
		$statement->setFetchMode(\PDO::FETCH_CLASS, Event::class);
		$result = $statement->fetch();
		if ($result === false) {
			throw new \Exception("Aucun résultat n'a été trouvé");
		}
		return $result;
	}

	public function hydrate(Event $event, array $data) {
		$event->setName($data['name']);
		$event->setDescription($data['description']);
		$event->setStart(\DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['date_start'])->format('Y-m-d H:i:s'));
		$event->setEnd(\DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['date_end'])->format('Y-m-d H:i:s'));
		return $event;
	}

	public function create(Event $event): bool {
		$statement = $this->pdo->prepare('INSERT INTO events (name, description, date_start, date_end) VALUES (?, ?, ?, ?)');
		return $statement->execute([
			$event->getName(), 
			$event->getDescription(),
			$event->getStart()->format('Y-m-d H:i:s'),
			$event->getEnd()->format('Y-m-d H:i:s')
		]);
	}

	public function update(Event $event): bool {
		$statement = $this->pdo->prepare('UPDATE events SET name = ?, description = ?, date_start = ?, date_end = ? WHERE id = ?');
		return $statement->execute([
			$event->getName(), 
			$event->getDescription(),
			$event->getStart()->format('Y-m-d H:i:s'),
			$event->getEnd()->format('Y-m-d H:i:s'),
			$event->getId()
		]);
	}

	public function delete(Event $event): bool {
		$statement = $this->pdo->prepare('DELETE FROM events WHERE id = ?');
		return $statement->execute([
			$event->getId()
		]);
	}

}

?>