<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.delete-btn');

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                const taakId = btn.getAttribute('data-id');
                const confirmDelete = confirm("Weet je zeker dat je deze taak wilt verwijderen?");

                if (confirmDelete) {
                    fetch(`delete.php`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `id=${taakId}&confirm=1`
                        })
                        .then(response => {
                            if (response.ok) {
                                btn.closest('.task-card').remove();
                                alert('Taak verwijderd!');
                            } else {
                                alert('Er is iets misgegaan.');
                            }
                        })
                        .catch(err => alert('Er is iets misgegaan.'));
                }
            });
        });
    });
</script>