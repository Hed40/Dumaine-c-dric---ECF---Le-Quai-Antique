$(document).ready(function() {
    $('#check-availability').on('click', function() {
        let date = $('date').val();
        let heure = $('heure').val();

        $.ajax({
            url: '/reservation',
            method: 'POST',
            data: { date: date, heure: heure },
            success: function(data) {
                if (data['#availability'] === 'Créneau disponible')  {
                    $('#availability').html('Créneau disponible');
                } else {
                    $('#availability').html('Créneau non disponible');
                }
            },
            error: function() {
                $('#availability').html('Une erreur s\'est produite.');
            }
        });
    });
});
