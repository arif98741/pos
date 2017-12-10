$(document).ready(function () {
    $.datepicker.setDefaults({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });

    $(function () { //date picker
        $('#date_input').datepicker();
    });

    $('.invoice_table').DataTable({

    });
    $('#product_table').DataTable({

    });

    $('.save_customer_bypop').click(function () {
        alert('hi');
    });

    function dateForAddSell() { // This is to display 12 hour format like you asked
        setInterval(function () {
            var date = new Date();
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var tempsec = date.getSeconds();
            var seconds = '';
            if (tempsec < 10) {
                seconds = '0' + tempsec;
            } else {
                seconds = tempsec;
            }

            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes;
            var strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
            $('.sell_product_time').html(strTime);
        }, 1000);

    }
    dateForAddSell();



});