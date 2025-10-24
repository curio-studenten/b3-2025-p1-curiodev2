<script>
// Wacht tot de hele HTML-pagina is geladen voor de programma werkt
document.addEventListener('DOMContentLoaded', () => {

    // Zoek alle knoppen met de class 'delete-btn(button)'
    const buttons = document.querySelectorAll('.delete-btn');

    buttons.forEach(btn => {

        // Voeg een klik-event toe aan elke knop
        btn.addEventListener('click', () => {

            // Haal het taak-ID op uit het 'data-id' attribuut van de knop
            const taakId = btn.getAttribute('data-id');

            // Vraag bevestiging aan de gebruiker
            const confirmDelete = confirm("Weet je zeker dat je deze taak wilt verwijderen?");

            // Alleen doorgaan als de gebruiker 'OK' klikt
            if (confirmDelete) {

                // Verstuur een HTTP POST-verzoek naar delete.php
                fetch(`delete.php`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded' // Stuur data zoals een normaal formulier
                        },
                        body: `id=${taakId}&confirm=1`
                    })
                    .then(response => {
                        if (response.ok) {

                            // Verwijderd de taak visueel
                            btn.closest('.task-card').remove();

                            alert('Taak verwijderd!');
                        } else {
                            alert('Er is iets misgegaan.');
                        }
                    })
                    // fout error als aangegeven
                    .catch(err => alert('Er is iets misgegaan.'));
            }
        });
    });
});
</script>