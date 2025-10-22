<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Taak aanmaken</title>
    <?php require_once 'head.php'; ?>
</head>

<body>
    <div class="container">
        <div class="form">
            <form action="../backend/taskController.php" method="POST">
                <input type="hidden" name="action" value="create">

                <div class="Taken">
                    <label for="titel">Titel:</label>
                    <input type="text" id="titel" name="titel" placeholder="Titel" required>
                </div>

                <div class="Taken">
                    <label for="afdeling">Afdeling:</label>
                    <input type="text" id="afdeling" name="afdeling" placeholder="Afdeling" required>
                </div>

                <div class="Taken">
                    <label for="beschrijving">Beschrijving:</label>
                    <textarea id="beschrijving" name="beschrijving" placeholder="Beschrijving" required></textarea>
                </div>

                <div class="Taken">
                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="">-- Kies status --</option>
                        <option value="todo">To Do</option>
                        <option value="in-progress">In Progress</option>
                        <option value="done">Done</option>
                    </select>
                </div>

                <button type="submit">Taak toevoegen</button>
                <p><a href="index.php">Terug naar Takenlijst</a></p>
            </form>
        </div>
    </div>
</body>
</html>