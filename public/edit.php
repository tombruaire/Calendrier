<?php 

require('../src/bootstrap.php');

$pdo = get_pdo();

$events = new Calendar\Events($pdo);

$errors = [];

try {
    $event = $events->find($_GET['id'] ?? null);
} catch (\Exception $e) {
    e404();
} catch (\Error $e) {
    e404();
}

$data = [
	'id' => $event->getId(),
	'name' => $event->getName(),
	'date' => $event->getStart()->format('Y-m-d'),
	'date_start' => $event->getStart()->format('H:i'),
	'date_end' => $event->getEnd()->format('H:i'),
	'description' => $event->getDescription()
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$data = $_POST;
	$validator = new Calendar\EventValidator();
	$errors = $validator->validates($data);
	if (empty($errors)) {
		$events->hydrate($event, $data);
		if (isset($_POST['modifier'])) {
			$events->update($event);
			header('Location: /index?edit=1');
		} elseif (isset($_POST['supprimer'])) {
			$events->delete($event);
			header('Location: /index?delete=1');
		}
		exit();
	}
}

render('header', ['title' => $event->getName()]);

?>

<div class="container mt-4">
	<div class="row d-flex justify-content-center">
		<h1 class="mb-3">Editer l'évènement : <small><?= $event->getName(); ?></small></h1>
		<form method="post" action="">
			<?php render('calendar/form', ['data' => $data, 'errors' => $errors]); ?>
			<div class="d-flex justify-content-center mt-4">
				<button type="submit" name="modifier" class="btn btn-primary me-2">Modifier l'évènement</button>
				<button type="submit" name="supprimer" class="btn btn-danger">Supprimer l'évènement</button>
			</div>
		</form>
	</div>
</div>

<?php render('footer'); ?>
