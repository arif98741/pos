$(document).ready(function () {

    storeSupplierInformation(); /*storing supplier information**/
    invoiceSystem(); //this is for managing invoice system

    function storeSupplierInformation() { //saving supplier information in addsupplier.php

        $('#add_supplier').click(function () {

            var data = {
                page: 'add_supplier',
                action: 'action',
                supplier_id: $('#supplier_id').val(),
                supplier_name: $('#supplier_name').val(),
                address: $('#address').val(),
                contact_no: $('#contact_no').val(),
                contact_person: $('#contact_person').val(),
                email: $('#email').val(),
                opening_balance: $('#opening_balance').val(),
                remark: $('#remark').val()
            };


            if (data.supplier_name === '' || data.supplier_id === '' || data.address === '' || data.conctact_no === '' || data.contact_person === '' || data.opening_balance === '' || data.remark === '') {
                $('#addsupplier_form_message').html('Field Must Not Be Empty.').show();
                messageFadeOut();
            } else {
                $.ajax({
                    url: 'functions.php',
                    data: data,
                    method: 'post',
                    success: function (response) {
                        $('#addsupplier_form_message').html(response).show();
                        messageFadeOut();
                        data = '';
                        data();
                    }, error: function (error) {
                        $('#addsupplier_form_message').html(error).show();

                    }
                });

            }
        });

        function messageFadeOut() {
            setTimeout(function () {
                $('#addsupplier_form_message').fadeOut(1000);
            }, 1000);

        }


    }

    function showSupplierdata() { //show supplier data in dropdown menu in addsupplier.php 
        $('.supplier_dropdown').change(function () {
            var x = $(this).val();

            $.ajax({
                url: 'functions.php',
                type: 'POST',
                data: {page: 'supplier', supplier_id: x},
                dataType: 'json',
                success: function (response) {
                    $('#supplier_name').html('<input class="form-control" id="supplier_name" value="' + response['0'] + '">');
                    $('#supplier_address').html('<input class="form-control" id="supplier_address" value="' + response['1'] + '">');
                    $('#supplier_contact').html('<input class="form-control" id="supplier_contact" value="' + response['2'] + '">');

                }, error: function (error_data) {
                    console.log(error_data);
                }
            });

        });
    }
    showSupplierdata();

    function invoiceSystem() {
        showInvoiceData();
        getProductById();
        var i_f_d = {
            invoice_no: '',
            date: '',
            time: '',
            supplier_id: ''
        };

        function showInvoiceData() { //this will show as soon as page appeared
            $.ajax({
                url: 'functions.php',
                data: {
                    page: "invoice",
                    action: 'show_invoice_products'
                },
                method: 'get',
                success: function (data) {
                    $('#invoice_product_data_table thead').append(data);
                }, error: function (error) {
                    alert(error);
                }
            });
        }

        function appendPreLoadedRow() {
            $.ajax({
                url: 'functions.php',
                data: {
                    page: "invoice",
                    action: 'show_invoice_products'
                },
                method: 'get',
                success: function (data) {
                    $('#invoice_form_table tbody').html(data);
                }, error: function (error) {
                    alert(error);
                }
            });

        }


        function getProductById() {
            appendPreLoadedRow();

            $('.add_invoice_btn').click(function () {

                i_f_d.invoice_no = $('#invoice_number').val();
                i_f_d.date = $('#date_input').val();
                i_f_d.time = $('#time_input').val();
                i_f_d.supplier_id = $('#supplier').val();

                if (i_f_d.supplier_id === '' || i_f_d.date === '' || i_f_d.supplier_id === '') {
                    appendPreLoadedRow();
                } else {


                    $.ajax({
                        url: "functions.php",
                        method: 'post',
                        data: {
                            page: 'page',
                            action: 'show_product_by_invoice_id',
                            invoice_no: i_f_d.invoice_no,
                            date: i_f_d.date,
                            supplier_id: i_f_d.supplier_id,
                        }, dataType: 'text',
                        success: function (data) {
                            $('#invoice_form_table tbody').html(data);

                        }, error: function (error) {

                        }

                    });
                }
                return false;
            });
        }


        function addRowAftertable() {
            var append = '';
            append += '<tr><td><input  type="text" class="form-control input_product_id"></td>'
                    + '</tr>';


            $('.add_new_invoice_table_row').click(function () {
                $('#invoice_form_table tbody:last-child').append(append);

                $('.input_product_id').blur(function () {
                    var product_id = $(this).val();
                    alert(product_id);
                });

                return false;
            });



        }
        addRowAftertable();

    }

});
