$(function () {
    $('.customer_data_dropdown').on('change', function () {
        var cus_id = $(this).val();
        if (cus_id !== '')
            $.ajax({
                url: "functions.php",
                method: 'post',
                data: {
                    page: 'addsell',
                    action: 'getcustomers',
                    customer_id: cus_id
                }, dataType: 'json',
                success: function (data) {
                    $('#customer_name').html(data.customer_name);
                    $('#customer_address').html(data.address);
                    $('#customer_contact').html(data.contact_no);
                    $('.customer_discount').val(data.discount);
                    $('.hidden_customer_id').val(data.customer_id);
                }, error: function (e) {
                }
            });
    });

    $('.pop_save_customer').click(function () {
        var pop = {
            cus_id: $('#pop_customer_id').val(),
            cus_name: $("#pop_customer_name").val(),
            cus_addr: $("#pop_customer_address").val(),
            cus_contact: $("#pop_customer_contact_no").val(),
            cus_discount: $("#pop_customer_discount").val(),
            cus_email: $("#pop_customer_email").val(),
            cus_opening_bal: $("#pop_customer_opening_balance").val(),
            cus_remark: $("#pop_customer_remark").val(),
            page: 'addsell',
            action: 'addpopupcustomer'

        };
        if (pop.cus_id === '' || pop.cus_name === '' || pop.cus_addr === '' || pop.cus_contact === '' || pop.cus_discount === '' || pop.cus_email === '' || pop.cus_opening_bal === '' || pop.cus_remark === '') {
            $('.pop_cus_error').html('<p class="alert alert-danger">Field Must Not be Empty.</p>').show().fadeOut(2000);
        } else {
            $.ajax({
                url: "functions2.php",
                method: 'get',
                data: pop,
                success: function (data) {
                    $('.pop_cus_error').html(data).show().fadeOut(3000);
                    getAllCustomers();
                    ClearInput();
                }, error: function (e) {
                    alert(e);
                }, async: false
            });
        }

    });

    function getAllCustomers() {

        $.ajax({
            url: "functions2.php",
            method: 'get',
            data: {
                page: 'addsell',
                action: 'getAllCustomers',
                behaviour: 'popup'
            },
            success: function (data) {
                $('.customer_data_dropdown').html(data);
            }, error: function (e) {
                alert(e);
            }
        });
    }

    function ClearInput() {
        $('#pop_customer_id').val('');
        $("#pop_customer_name").val('');
        $("#pop_customer_address").val();
        $("#pop_customer_contact_no").val('');
        $("#pop_customer_discount").val('');
        $("#pop_customer_email").val('');
        $("#pop_customer_opening_balance").val('');
        $("#pop_customer_remark").val('');

    }

});

