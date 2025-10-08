<!doctype html>
<html lang="nl">

<head>
    <title></title>
    <?php require_once 'head.php'; ?>
</head>

<body>
    
    <div class="container">
        <h1>Nieuwe Taak Formulier</h1>

        <form action="../../../backend/tasksController.php" method="POST">
            <div class="Taken">
                <label for="titel">Titel: </label>
                <input type="text" id="titel" placeholder="Titel">
            </div>

            <div class="Taken">
                <label for="afdeling">Afdeling: </label>
                <input type="text" id="afdeling" placeholder="Afdeling">
            </div>

            <div class="Taken">
                <label for="beschrijving">Beschrijving: </label>
                <input type="textarea" id="beschrijving" placeholder="Beschrijving">
            </div>

            <div>
                <label for="status">Status</label>
                <select id="status" name="status" required>
                <option value="">-- Kies status --</option>
                <option value="todo">To Do</option>
                <option value="in-progress">In Progress</option>
                <option value="done">Done</option>
            </div>
             <button type="submit">Taak toevoegen</button>
        </form>

    </div>

</body>

</html>