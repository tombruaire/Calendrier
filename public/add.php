<?php

require('../src/bootstrap.php');

$data = [
	'date' => $_GET['date'] ?? date('Y-m-d'),
	'date_start' => date('H:i'),
	'date_end' => date('H:i')
];

$validator = new \App\Validator($data);

if (!$validator->validate('date', 'date')) {
	$data['date'] = date('Y-m-d');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$data = $_POST;
	$validator = new Calendar\EventValidator();
	$errors = $validator->validates($_POST);
	if (empty($errors)) {
		$events = new \Calendar\Events(get_pdo());
		$event = $events->hydrate(new \Calendar\Event(), $data);
		$events->create($event);
		header('Location: /index?success=1');
		exit();
	}
}

render('header', ['title' => 'Ajouter un évènement']);

?>

<div class="container mt-4">
	<div class="row d-flex justify-content-center">
		<?php if (!empty($errors)): ?>
		<div class="alert alert-danger" role="alert">
		  	Merci de corriger vos erreurs
		</div>
		<?php endif; ?>
		<h1 class="text-center mb-3">Ajouter un évènement</h1>
		<form method="post" action="">
			<?php render('calendar/form', ['data' => $data, 'errors' => $errors]); ?>
			<div class="d-flex justify-content-center mt-4">
				<button type="submit" name="" class="btn btn-primary">Ajouter l'évènement</button>
			</div>
		</form>
	</div>
</div>

<?php render('footer'); ?>
