$(document).ready(function() {
    $('#check-availability').on('click', function() {
        let date = $('date').val();
        let heure = $('heure').val();

        $.ajax({
            url: '/reservation',
            method: 'POST',
            data: { date: date, heure: heure },
            success: function(data) {
                if (data['#availability'] === 'table available')  {
                    $('#availability').html('table available');
                } else {
                    $('#availability').html('table NOT available');
                }
            },
            error: function() {
                $('#availability').html('Une erreur s\'est produite.');
            }
        });
    });
});
