<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Taak aanmaken</title>
    <?php require_once '../head.php'; ?>
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
                <select id="afdeling" name="afdeling" required>
                    <option value="">-- Kies afdeling --</option>
                    <option value="personeel">Personeel</option>
                    <option value="horeca">Horeca</option>
                    <option value="techniek">Techniek</option>
                    <option value="inkoop">Inkoop</option>
                    <option value="klantenservice">Klantenservice</option>
                    <option value="groen">Groen</option>
                    <option value="kantoor">Kantoor</option>
                </select>
            </div>

                <div class="Taken">
                    <label for="beschrijving">Beschrijving:</label>
                    <textarea id="beschrijving" name="beschrijving" placeholder="Beschrijving" required></textarea>
                </div>

                <!-- Deadline veld: datum waarop de taak af moet zijn -->
                <div class="Taken">
                    <label for="deadline">Deadline:</label>
                    <input type="date" id="deadline" name="deadline">
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
            </form>
        </div>
    </div>
</body>

</html>