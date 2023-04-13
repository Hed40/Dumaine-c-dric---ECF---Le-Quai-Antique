$(document).ready(function () {
    function updateTimeSlots(slot) {
        let timeSlotsHtml = '';

        $.each(slot, function (index, slot) {
            const slotClass = slot.isAvailable ? 'btn-success' : 'btn-danger';
            const disabledAttr = slot.isAvailable ? '' : 'disabled';
            const $places = slot.places;
            timeSlotsHtml += `<button type="submit" class="btn ${slotClass} mr-2 mb-2" ${disabledAttr}>${slot.heure}</button>`;
        });
        $('#time-slots').html(timeSlotsHtml); // Utiliser timeSlotsHtml au lieu de timeSlotsHtml2
    }

    function updateTimeSlots2(slot2) {
        let timeSlots2Html = '';

        $.each(slot2, function (index, slot2) {
            const slotClass = slot2.isAvailable ? 'btn-success' : 'btn-danger';
            const disabledAttr = slot2.isAvailable ? '' : 'disabled';
            const $places2 = slot2.places;
            timeSlots2Html += `<button type="submit" class="btn ${slotClass} mr-2 mb-2" ${disabledAttr}>${slot2.heure}</button>`;
        });
        $('#time-slots2').html(timeSlots2Html);
    }

    function checkAvailability() {
        const guestsNumber = $('#reservation_form_guestsNumber').val();
        const date = $('#reservation_form_date').val();
        const heure = $('#reservation_form_heure').val();

        $.ajax({
            url: '/reservation/gettimeslots',
            method: 'POST',
            data: {
                'guestsNumber': guestsNumber,
                'date': date,
                'heure': heure
            },
            success: function (response) {
                updateTimeSlots(response.slot);
                updateTimeSlots2(response.slot2);
            },
            error: function () {
                console.error('Erreur lors de la récupération des disponibilités.');
            }
        });
    }

    // Appeler checkAvailability() lorsque l'un des champs change en fonction du nombre de couvert, date et heure.
    $('#reservation_form_guestsNumber, #reservation_form_date, #reservation_form_heure').on('change', function () {
        checkAvailability();
    });

    // Appeler checkAvailability() au chargement de la page
    checkAvailability();
});

