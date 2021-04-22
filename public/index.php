<?php 

require('../src/bootstrap.php');

$pdo = get_pdo();

$events = new Calendar\Events($pdo);

$month = new Calendar\Month($_GET['month'] ?? null, $_GET['year'] ?? null); 

$start = $month->getStartingDay();

$start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');

$weeks = $month->getWeeks();

$end = (clone $start)->modify('+' . (6 + 7 * ($weeks - 1)) . ' days');

$events = $events->getEventsBetweenByDay($start, $end);

require('../views/header.php');

?>

<div class="calendar">

    <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
        <h1><?= $month->toString(); ?></h1>
        <?php if (isset($_GET['success'])): ?>
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                L'évènement a bien été enregistré !
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <?php endif; ?>

        <?php if (isset($_GET['edit'])): ?>
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                L'évènement a bien été modifié !
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <?php endif; ?>

        <?php if (isset($_GET['delete'])): ?>
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                L'évènement a bien été supprimé !
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <?php endif; ?>
        <div>
            <a class="btn btn-primary" href="/index.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>">&lt;</a>
            <a class="btn btn-primary" href="/index.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>">&gt;</a>
        </div>
    </div>

    <table class="calendar__table calendar__table--<?= $weeks; ?>weeks">
        <?php for ($i = 0; $i < $weeks; $i++): ?>
        <tr>
            <?php 
            foreach ($month->days as $k => $day): 
                $date = (clone $start)->modify("+" . ($k + $i * 7) . "days");
                $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
                $isToday = date('Y-m-d') === $date->format('Y-m-d');
            ?>
            <td class="<?= $month->withinMonth($date) ? '' :  'calendar__othermonth'; ?> <?= $isToday ? 'is-today' :  ''; ?>">
                <?php if ($i === 0): ?>
                    <div class="calendar__weekday"><?= $day; ?></div>
                <?php endif; ?>
                <a class="calendar__day" href="add.php?date=<?= $date->format('Y-m-d'); ?>"><?= $date->format('d'); ?></a> 
                <?php foreach ($eventsForDay as $event): ?>
                <div class="calendar__event">
                    <a href="/edit.php?id=<?= $event['id']; ?>">
                        <div class="card text-dark bg-light mt-2">
                            <div class="card-body">
                                <?= (new DateTime ($event['date_start']))->format('H:i'); ?> - <?= $event['name']; ?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </td>
            <?php endforeach; ?>
        </tr>
        <?php endfor; ?>
    </table>

    <a class="calendar__button" href="/add.php">+</a>

</div>

<?php require('../views/footer.php'); ?>
