<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaakVerdeling</title>
</head>
<body>
    <div class="main-flex">
        <nav class="sidebar">
            <h2>Taak Overzicht</h2>
            <ul class="sidebar-list">
                <?php
                $tasksByStatus = getTasksByStatus();
                $hasTasks = false;
                foreach (['todo', 'in-progress', 'done'] as $status) {
                    foreach ($tasksByStatus[$status] as $taak) {
                        $hasTasks = true;
                        $statusClass = ($status === 'in-progress') ? 'in-progress-header' : $status . '-header';
                        echo '<li class="sidebar-task">'
                            . '<span class="sidebar-title">' . $taak['titel'] . '</span> '
                            . '<span class="' . $statusClass . ' sidebar-status">' . $taak['status'] . '</span>'
                            . '</li>';
                    }
                }
                if (!$hasTasks) {
                    echo '<li>Geen taken gevonden.</li>';
                }
                ?>
            </ul>
        </nav>
</body>
</html>