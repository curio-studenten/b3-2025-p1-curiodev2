<!doctype html>
<html lang="nl">

<head>
    <title></title>
    <?php require_once 'head.php'; ?>
</head>

<body>

    <div class="container">
        <h1>Nieuwe Taak Formulier</h1>

        <form action="../backend/taskController.php" method="POST">
            <input type="hidden" name="action" value="create">

            <label for="titel">Titel:</label>
            <input type="text" id="titel" name="titel" required>

            <label for="beschrijving">Beschrijving:</label>
            <textarea id="beschrijving" name="beschrijving" required></textarea>

            <label for="afdeling">Afdeling:</label>
            <input type="text" id="afdeling" name="afdeling" required>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="todo">To Do</option>
                <option value="doing">Doing</option>
                <option value="done">Done</option>
            </select>

            <button type="submit">Taak toevoegen</button>
        </form>

    </div>

</body>

</html>