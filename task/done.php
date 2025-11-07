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
                // Loop door de verschillende statusen: todo, in-progress en done
                foreach (['todo', 'in-progress', 'done'] as $status) {
                    foreach ($tasksByStatus[$status] as $taak) {
                        $hasTasks = true;
                        $statusClass = ($status === 'in-progress') ? 'in-progress-header' : $status . '-header';
                        
                        // Toon de deadline als deze is ingesteld
                        $deadlineText = '';
                        if (!empty($taak['deadline'])) {
                            // Format de datum naar Nederlands formaat (dd-mm-yyyy)
                            $deadlineDate = date('d-m-Y', strtotime($taak['deadline']));
                            $deadlineText = ' <span class="deadline">📅 ' . $deadlineDate . '</span>';
                        }
                        
                        echo '<li class="sidebar-task">'
                            . '<span class="sidebar-title">' . $taak['titel'] . '</span> '
                            . '<span class="' . $statusClass . ' sidebar-status">' . $taak['status'] . '</span>'
                            . $deadlineText
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