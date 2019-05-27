const Repeat = {
    NONE: 1,
    DAILY: 2,
    CUSTOM: 3
};

$(document).ready(function () {
    var input_number = $('#input_select input');
    var input_select = $('#input_select select');
    var etykieta = $('#input_etykieta input');
    var input_lokalizacja = $('#input_lokalizacja input');
    var input_listamaszyn = $('#id_listamaszyn input');

    document.getElementById('input_select').disabled;
    // skrypt do czyszczenia etykiety buttonem

    $('.etButton').click(function () {
        etykieta.val('');
    });
    // zaznacz/odznacz wszystko
    $('#zaznacz_wszystko').click(function () {
        input_listamaszyn.prop('checked', true);
    });
    $('#odznacz_wszystko').click(function () {
        input_listamaszyn.prop('checked', false);
    });

    $('input:radio[name=radio]').change(function () {
        //var input_number = $('#input_select input');
        //var input_select = $('#input_select select');
        if (this.value == Repeat.CUSTOM) {
            input_number.prop('disabled', false);
            input_select.prop('disabled', false);
        } else {
            input_number.prop('disabled', true);
            input_select.prop('disabled', true);
            input_number.val('1'); // powrót do domyślnej wartości 1
            input_select.val('1'); // powrót do domyślnej wartości "tydzień"
            input_number.prop('checked', false); //dni tygodnia
        }
    });

    // skrypt do czyszczenia formularza

    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var modal = $(this);
        var recipient = button.data('whatever'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var date_input = $('.date_input');
        var today = new Date();
        var time_input = $('.time_input');
        date_input.val(FormatDate(today));
        time_input.val(FormatTime(today));

        $('input:radio[name=radio]').first().prop('checked', true);
        input_number.prop('disabled', true);
        input_select.prop('disabled', true);
        input_number.val('1'); // powrót do domyślnej wartości 1
        input_select.val('1'); // powrót do domyślnej wartości "tydzień"
        input_number.prop('checked', false);

        modal.find('.etykieta').val(''); //czyszczenie etykiety przy otwarciu formularza
        input_lokalizacja.val('');
        input_listamaszyn.prop('checked', false);


        if (button.is('a')) { // TU MUSI POBRAĆ DANE Z PÓL Z LISTY
            var name = button.parent().parent().find('.name').html();
            modal.find('.etykieta').val(name);
        } else { // ZMIANA METODY FORNULARZA NA TWORZENIE NOWEGO BACKUPU W PHPIE
            $("#myModal > div > form").attr('action', '/plan/add');
        }
    });

    $('#id_zapytanie').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var modal = $(this);
        var name = button.parent().parent().find('.name').html();
        modal.find('#take_name').html(name);
    });



});


function FormatDate(date) {
    var day = date.getDate(),
        month = (date.getMonth() + 1);

    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }

    return date.getFullYear() + "-" + month + "-" + day;
}

function FormatTime(time) {
    var hour = time.getHours(),
        minutes = time.getMinutes();

    if (hour < 10) {
        hour = "0" + hour;
    }
    if (minutes < 10) {
        minutes = "0" + minutes;
    }

    return hour + ":" + minutes;
}
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Money Euro
    $('[data-mask]').inputmask()
})