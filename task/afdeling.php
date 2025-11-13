<?php

// Zet de juiste content-type header
header('Content-Type: text/html; charset=utf-8');

// Verbind met de database
require_once __DIR__ . '/../backend/conn.php';

// Alle afdelingen (voor de navigatie)
$departments = [
    'personeel'      => ['title' => 'Personeel'],
    'horeca'         => ['title' => 'Horeca'],
    'techniek'       => ['title' => 'Techniek'],
    'inkoop'         => ['title' => 'Inkoop'],
    'klantenservice' => ['title' => 'Klantenservice'],
    'groen'          => ['title' => 'Groen'],
    'kantoor'        => ['title' => 'Kantoor']
];

// Ophalen en veilig maken van de GET-parameter
$afdeling = isset($_GET['afdeling']) ? strtolower(trim($_GET['afdeling'])) : null;

// Hulpfunctie om tekst veilig te tonen (tegen XSS)
function e($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="nl">
<head>
 <?php  require_once '../head.php'; ?>
</head>
<body>

<div class="links">
    <a href="create.php" class="btn-new-task">+ Nieuwe Taak</a>
    <a href="index.php" class="btn-new-task">Taken Lijst</a>
</div>
<h1>Afdelingen</h1>

<!-- Navigatie met links naar alle afdelingen -->
<nav>
  <a href="afdeling.php">Alle afdelingen</a>
  <?php foreach ($departments as $key => $info): ?>
    <a href="afdeling.php?afdeling=<?php echo e($key); ?>">
      <?php echo e($info['title']); ?>
    </a>
  <?php endforeach; ?>
</nav>

<hr>

<?php if ($afdeling === null): ?>

  <!-- Geen specifieke afdeling gekozen -->
  <h2>Overzicht van alle afdelingen</h2>
  <ul>
    <?php foreach ($departments as $key => $info): ?>
      <li>
        <strong><?php echo e($info['title']); ?></strong> —
        <a href="afdeling.php?afdeling=<?php echo e($key); ?>">Bekijk taken</a>
      </li>
    <?php endforeach; ?>
  </ul>

<?php elseif (array_key_exists($afdeling, $departments)): ?>

  <!-- Gekozen afdeling: haal taken op uit de database -->
  <?php
  $stmt = $conn->prepare("SELECT * FROM taken WHERE afdeling = :afdeling ORDER BY id DESC");
  $stmt->execute([':afdeling' => $afdeling]);
  $taken = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>

  <h2>Afdeling: <?php echo e($departments[$afdeling]['title']); ?></h2>

  <?php if (count($taken) > 0): ?>
    <?php foreach ($taken as $taak): ?>
      <div class="taak">
        <h3><?php echo e($taak['titel']); ?></h3>
        <p><?php echo e($taak['beschrijving']); ?></p>
        <small>Status: <?php echo e($taak['status']); ?></small>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Er zijn momenteel geen taken geregistreerd voor deze afdeling.</p>
  <?php endif; ?>

<?php else: ?>

  <!-- Afdeling niet gevonden -->
  <h2>Afdeling niet gevonden</h2>
  <p>De afdeling "<?php echo e($afdeling); ?>" bestaat niet. Kies een beschikbare afdeling hierboven.</p>

<?php endif; ?>

</body>
</html>