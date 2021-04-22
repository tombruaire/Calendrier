<div class="row">
	<div class="col-sm-6">
		<div class="mb-3">
			<label for="titre" class="form-label">Titre de l'évènement</label>
			<input type="text" name="name" id="titre" class="form-control" required="required" value="<?= isset($data['name']) ? $data['name'] : ''; ?>">
			<?php if (isset($errors['name'])): ?>
				<div class="form-text text-muted"><?= $errors['name']; ?></div>
			<?php endif; ?>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="mb-3">
			<label for="date" class="form-label">Date</label>
			<input type="date" name="date" id="date" class="form-control" required="required" value="<?= isset($data['date']) ? $data['date'] : ''; ?>">
			<?php if (isset($errors['date'])): ?>
				<div class="form-text text-muted"><?= $errors['date']; ?></div>
			<?php endif; ?>
		</div>
	</div>
</div>
<div class="row mb-3">
	<div class="col-sm-6">
		<div class="mb-3">
			<label for="heure_start" class="form-label">Heure de démarrage</label>
			<input type="time" name="date_start" id="heure_start" class="form-control" required="required" value="<?= isset($data['date_start']) ? $data['date_start'] : ''; ?>">
			<?php if (isset($errors['date_start'])): ?>
				<div class="form-text text-muted"><?= $errors['date_start']; ?></div>
			<?php endif; ?>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="mb-3">
			<label for="heure_end" class="form-label">Heure de fin</label>
			<input type="time" name="date_end" id="heure_end" class="form-control" required="required" value="<?= isset($data['date_end']) ? $data['date_end'] : ''; ?>">
		</div>
	</div>
</div>
<div class="mb-3">
	<label for="description" class="form-label">Description de l'évènement</label>
	<textarea name="description" id="description" class="form-control"><?= isset($data['description']) ? $data['description'] : ''; ?></textarea>
</div>