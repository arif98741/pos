$(document).ready(function () {
    storeSupplierInformation(); /*storing supplier information**/
    showSupplierdata(); //showing data in invoice table at supplierlist.php
    storeCustomerInformation(); //storing customer information in the database
    fadeOut();
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
                data: {
                    action: 'getsuppliers',
                    page: 'supplier',
                    supplier_id: x
                },
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

    function storeCustomerInformation() {
        $('#add_customer').click(function () {
            var data = {
                page: 'add_customer',
                action: 'insert_customer',
                customer_id: $('#customerid').val(),
                customer_name: $('#customername').val(),
                address: $('#address').val(),
                contact_no: $('#contactno').val(),
                email: $('#email').val(),
                opening_balance: $('#opening_balance').val(),
                remark: $('#remark').val(),
                discount: $('#discount').val()
            };


            if (data.customer_id === '' || data.customer_name === '' || data.address === '' || data.contact_no === '' || data.contactperson === '' || data.email === '' || data.openingbalance === '' || data.remark === '' || data.discount === '') {
                $('#addcustomer_form_message').html('Field Must Not Be Empty.').show();
                messageFadeOut();
            } else {
                $.ajax({
                    url: 'functions2.php',
                    data: data,
                    method: 'post',
                    success: function (response) {
                        $('#addcustomer_form_message').html(response).show();
                        messageFadeOut();
                    }, error: function (error) {
                        $('#addcustomer_form_message').html(error).show();
                        messageFadeOut();
                    }
                });

            }
        });

        function messageFadeOut() {
            setTimeout(function () {
                $('#addcustomer_form_message').fadeOut(1000);
            }, 1000);

        }
    }

    function fadeOut() { //showing several message and hide message
        setTimeout(function () {
            $('.fadeout').slideUp(500);
        }, 2000);
    }

});

$(function () { //invoice management

    //showing invoice Products by specific invoice id
    function showInvoiceInAddRowPage() {
        var invoice_no = $('#invoice_number').val();
        var date = $("#date_input").val();
        var supplier = $("#supplier").val();

        if (invoice_no != '' && date != '' && supplier != 'select')
        {
            $.ajax({
                url: 'functions.php',
                method: 'GET',
                data: {
                    page: 'page',
                    action: 'showInvoiceList',
                },
                success: function (data) {
                    $('#invoice_product_data_table').append(data);
                }, error: function (er) {

                }
            });
        } else {

        }
    }

    function addnewrow() {
        var groups = '';
        $.ajax({
            url: "functions.php",
            method: 'get',
            data: {
                page: 'addinvoice',
                action: 'getgroups'
            }, success: function (d) {
                groups = d;
                //console.log(groups);
            }, error: function (e) {
                alert(e);
            }, async: false
        });
        var row = '<tr style="text-align:center;">'
                + '<td width="10%">' + '<input name="product_id[]" type="text" class="form-control product_id" required >' + '</td>'
                + '<td width="10%">' + groups + '</td>'
                + '<td width="10%">' + '<b class="product_name"></b>' + '</td>'
                + '<td width="10%">' + '<b class="product_type"></b>' + '</td>'
                + '<td width="8%">' + '<b class="size_h"></b>' + '</td>'
                + '<td width="8%">' + '<b class="size_w"></b>' + '</td>'
                + '<td width="8%">' + '<input type="text" name="quantity[]" class="form-control quantity" required >' + '</td>'
                + '<td width="8%">' + '<input type="text" name="carton[]"  class="form-control carton" required >' + '</td>'
                + '<td width="8%">' + '<input type="text" name="piece[]"  class="form-control piece">' + '</td>'
                + '<td width="8%">' + '<input type="text" name="purchase[]" class="form-control purchase" required >' + '</td>'
                + '<td width="6%">' + '<input type="hidden" name="subtotalforsave[]" class="form-control subtotalforsave"><b class="subtotal">0</b> ' + '</td>'
                + '</tr>';

        $('#inv_detail').append(row);

    }

    //addition of new row in addinvoice table by click
    $('.add_new_invoice_table_row').click(function () {
        addnewrow();
    });

    $('#inv_detail').delegate('.product_id,.product_name', 'keyup', function (e) {
        var tr = $(this).parent().parent();
        var product_id = $(this).val();
        var data = foo(product_id); //asyncronus function calling from foo
        tr.find('.product_name').html(data['product_name']);
        tr.find('.product_type').html(data['product_type']);
        tr.find('.size_h').html(data['size_h']);
        tr.find('.size_w').html(data['size_w']);

        //tr.find('.product_group').html(data['product_group']);

    });

    //select group in dropdown for finding product
    $('#inv_detail').delegate('.product_group', 'change', function (e) {
        var tr = $(this).parent().parent();
        var group_id = $(this).val();
        var namelist = '';
        $.ajax({
            url: "functions.php",
            method: 'post',
            data: {
                page: 'addinvoice',
                action: 'productnamelist',
                group_id: group_id
            }, success: function (data) {
                namelist = data;
            }, error: function (e) {
                console.log(e);
            }, async: false
        });

        tr.find('.product_name').html(namelist);
    });

    //select single product in product list dropdown for finding product details and assign in form fields
    $('#inv_detail').delegate('.product_list', 'change', function (e) {
        var tr = $(this).parent().parent();
        var pro_id = $(this).val();

        var d = getSingleProDetails();
        var t = $(this).parent().parent().parent();
        t.find('.product_id').val(d['product_id']);
        t.find('.product_type').html(d['product_type']);
        t.find('.size_h').html(d['size_h']);
        t.find('.size_w').html(d['size_w']);

        function getSingleProDetails() {
            var details = [];
            $.ajax({
                url: "functions.php",
                method: 'post',
                data: {
                    page: 'addinvoice',
                    action: 'getprodetails',
                    pro_id: pro_id
                }, dataType: 'json',
                success: function (d) {
                    details = d;
                }, error: function (e) {
                    console.log(e);
                }, async: false
            });
            return details;
        }
    });



    //counting management
    $('#inv_detail').delegate('.quantity,.carton,.piece,.purchase,.subtotal,.wholetotal', 'keyup', function () {
        var tr = $(this).parent().parent();
        var quantity = tr.find('.quantity').val() - 0;
        var carton = tr.find('.carton').val() - 0;
        var piece = tr.find('.piece').val() - 0;
        var purchase = tr.find('.purchase').val() - 0;
        var subtotal = piece * purchase;
        var total = subtotal * purchase;
        tr.find('.piece').val(carton * quantity);
        tr.find('.subtotal').html(subtotal);
        tr.find('.subtotalforsave').val(subtotal); //for saving data to the server
        tr.find('.total').html(total);
        tr.find('.totalforsave').val(total); //for saving data to server
        wholetotal();

    });

    //delete appended row from the addinvoice table
    $('#inv_detail').delegate('.deleterow', 'click', function () {
        $(this).parent().parent().fadeOut(300);

    });


    //getting product details by specific product id
    function foo(product_id) {
        var result;
        $.ajax({
            url: "functions.php",
            method: 'get',
            data: {
                page: 'page',
                action: 'showproductbyid',
                product_id: product_id
            },
            dataType: 'json',
            success: function (data) {
                result = data;
            }, error: function (err) {
            }, async: false
        });

        return result;
    }

    //total function for calculating the value of different fields
    function wholetotal() {
        var total = 0;
        $('.subtotal').each(function (i, e) {
            var amt = parseFloat($(this).html());
            total += amt;
        });

        $('.wholetotal').html(total);
    }


});

$(function () { //sales management

    //product_id entering by keypress
    $('#product_add_body').delegate('.product_id', 'keyup', function () {

        var product_id = $(this).val();
        var tr = $(this).parent().parent().parent();
        var result = foo(product_id);
        tr.find('.product_name').html(result['product_name']);
        tr.find('.product_color').val(result['color']);
        tr.find('.product_size').val(result['size_h']);
        tr.find('.total_price').val(result['unit_price'] + '.00');
        tr.find('.unit_price').val(result['unit_price'] + '.00');
    });

    //changing product group from dropdown
    $('#product_add_body').delegate('.product_group_dropdown', 'change', function (e) {

        var tr = $(this).parent().parent();
        var group_id = $(this).val();
        var namelist = '';
        $.ajax({
            url: "functions.php",
            method: 'post',
            data: {
                page: 'addinvoice',
                action: 'productnamelist',
                group_id: group_id
            }, success: function (data) {
                namelist = data;
            }, error: function (e) {
                console.log(e);
            }, async: false
        });
        var d = $(this).parent().parent().parent().parent();

        d.find('.product_name').html(namelist);
    });

    //selecting product list after first dropdown selection 
    $('#product_add_body').delegate('.product_list', 'change', function (e) {
        var pro_id = $(this).val();
        var t4 = $(this).parent().parent().parent().parent();

        var d = getSingleProDetails();
        t4.find('.product_id').val(d['product_id']);
        t4.find('.product_size').val(d['size_h']);
        t4.find('.product_color').val(d['color']);
        t4.find('.total_price').val(d['unit_price'] + '.00');
        t4.find('.unit_price').val(d['unit_price'] + '.00');
        calculateCost();


        function getSingleProDetails() {
            var details = [];
            $.ajax({
                url: "functions.php",
                method: 'post',
                data: {
                    page: 'addinvoice',
                    action: 'getprodetails',
                    pro_id: pro_id
                }, dataType: 'json',
                success: function (d) {
                    details = d;
                }, error: function (e) {
                    console.log(e);
                }, async: false
            });
            return details;
        }
    });

    $('#product_add_body').delegate('.product_carton', 'keyup', function () {
        var tr = $(this).parent().parent();
        var carton = $(this).val();
        var discount = tr.find('.discount').val();
        tr.find('.product_piece').val(carton);
        calculateCost();
    });

    $('#product_add_body').delegate('.product_piece', 'keyup', function () {
        var tr = $(this).parent().parent();
        var carton = $(this).val();
        var discount = tr.find('.discount').val();
        tr.find('.product_piece').val(carton);
        calculateCost();
    });
    $('#product_add_body').delegate('.discount', 'keyup', function () {
        calculateCost();
    });

    function calculateCost() {
        //var tr = $(this).parent().parent().parent();
        var piece = total_price = unit_price = 0;
        var piece = $('.product_piece').val();
        var total_price = $('.total_price').val();
        var unit_price = total_price * piece;
        var discount = $(".discount").val();
        var sub_total = unit_price - (unit_price * (discount / 100));

        $('.unit_price').val(parseFloat(unit_price));
        $('.subtotal').val(parseFloat(sub_total.toFixed(2)));
        getTotalSellValue();

    }

    //add new product in the buy product list
    addNewProduct();
    function addNewProduct() {

        $('.add_new_product').click(function () {
            var product_data = {
                page: 'addsell',
                action: 'addsellproducts',
                product_id: $('.product_id').val(),
                product_name: $('.product_name').val(),
                product_size: $('.product_size').val(),
                product_color: $('.product_color').val(),
                product_quantity: $('.product_quantity').val(),
                product_stock: $('.product_stock').val(),
                product_carton: $('.product_carton').val(),
                product_piece: $('.product_piece').val(),
                total_price: $(".total_price").val(),
                unit_price: $(".unit_price").val(),
                sub_total: $(".subtotal").val(),
                customer_id: $('.customer_data_dropdown').val(),
                sell_id: $('.sell_id').val()
            };
            if (product_data.product_id === '' || product_data.product_size === '' || product_data.product_color === '' || product_data.product_quantity === '' || product_data.product_stock === '' || product_data.product_carton === '' || product_data.product_piece === '' || product_data.total_price === '' || product_data.unit_price === '' || product_data.sub_total === '') {
                alert('field must not be empty');
            } else if (product_data.customer_id === '' || product_data.customer_id === 'Select') {
                alert('Please Select Customer');
            } else {
                $.ajax({
                    url: 'functions2.php',
                    data: product_data,
                    method: 'post',
                    success: function (data) {
                        showSellProducts(product_data.sell_id);
                        getTotalSellValue();
                        sellCalculation();
                        if ($.trim(data) === 'added') {
                            alert("Product Already Added");
                        } else if ($.trim(data) === 'not found') {
                            alert("Product Not Found");
                        }
                    }, error: function (e) {

                    }
                });
            }
        });
    }


    //remove single sell product by product id
    removeSingleSellProduct();
    function removeSingleSellProduct() {
        $('.sell_products_table').delegate('.remove_sell_product', 'click', function () {
            var pro_id = $(this).attr('product_id');
            $.ajax({
                url: "functions2.php",
                data: {
                    page: 'addsell',
                    action: 'removesellproducts',
                    product_id: pro_id,
                    sell_id: $('.sell_id').val()
                },
                method: 'post',
                success: function (data) {
                    showSellProducts($('.sell_id').val());
                    getTotalSellValue();
                    sellCalculation();
                }, error: function (e) {
                    alert(e);
                }
            });
        });
    }

    //remove added sell products by bootstrap modal popup in addsell.php
    updateSingleSaleProduct();
    function updateSingleSaleProduct() {
        $('.sell_products_table').delegate('.update_sell_product', 'click', function () {
            var s_pro_id = $(this).attr('sell_product_id');
            var s_cus_id = $(this).attr('sell_customer_id');
            var s_sell_id = $(this).attr('sell_sell_id');
            $('#update_product_id').val(s_pro_id);
            $.ajax({
                url: "functions2.php",
                method: 'post',
                data: {
                    s_sell_id: s_sell_id,
                    s_cus_id: s_cus_id,
                    s_pro_id: s_pro_id,
                    action: 'getSingleProductDataForUpdate'

                }, dataType: 'json',
                success: function (data) {
                    $('#update_product_quantity').val(data.quantity);
                    $('#update_product_customer_id').val(data.customer_id);
                    $('#update_product_piece').val(data.product_piece);
                    var u_price = parseFloat(data.unit_price);
                    var sub_total = parseFloat(data.subtotal);
                    $('#update_product_unit_price').val(u_price.toFixed(2));
                    $('#update_product_subtotal').val(sub_total);

                },
                error: function (e) {
                    console.log(e);
                }
            });
            $('#edit_sell_product_body').modal('show');

        });
    }
    //update tbl_sell_product popup start
    $('.update_sell_product_table_body').delegate('#update_product_quantity', 'keyup', function () {
        var quantity = $(this).val();
        $('#update_product_piece').val(quantity);
        updatePopupSellProductCalculation();
    });

    $('.update_sell_product_table_body').delegate('#update_product_vat,#update_product_quantity,#update_product_piece,#update_product_quantity', 'keyup', function () {
        var quantity = $(this).val();
        updatePopupSellProductCalculation();

    });

    //update sell product to database

    function updatePopupSellProductCalculation() {
        var qty = $('#update_product_piece').val();
        var pce = $('#update_product_piece').val();
        var vat = $('#update_product_vat').val();
        var upri = $('#update_product_unit_price').val();
        var pi_upri = pce * upri;
        vat = vat / 100;
        vat = pi_upri * vat;
        var sub_total = pi_upri + vat;
        $('#update_product_subtotal').val(sub_total.toFixed(2));
        $('.addsell_popup_update_error').html(pi_upri.toFixed(2));
    }

    updateSingleProductForDatabase();
    function updateSingleProductForDatabase() {
        $('.update_sell_product_btn').click(function () {
            var data = {
                action: 'updateSingleProductForDatabase',
                page: 'addsell',
                sell_id: $('.sell_id').val(),
                cus_id: $('#update_product_customer_id').val(),
                pro_id: $('#update_product_id').val(),
                quantity: $('#update_product_piece').val(),
                piece: $('#update_product_piece').val(),
                unit_price: $('#update_product_unit_price').val(),
                sub_total: $('#update_product_subtotal').val()
            };

            if (data.quantity === '' || data.piece === '' || data.unit_price === '' || data.sub_total === '') {
                $('.addsell_popup_update_error').html('<p class="alert alert-danger">Field Must Not be Empty').show();
                setTimeout(function () {
                    $('.addsell_popup_update_error').fadeOut(500);
                }, 2500);
            } else {
                $.ajax({
                    url: "functions2.php",
                    method: 'post',
                    data: data,
                    success: function (msg) {
                        $('.addsell_popup_update_error').html(msg).show();
                        showSellProducts($('.sell_id').val());
                        sellCalculation();
                        getTotalSellValue();
                        setTimeout(function () {
                            $('.addsell_popup_update_error').fadeOut(500);
                        }, 500);
                    },
                    error: function (err) {
                        alert(err);
                    }
                });
            }

        });
    }


    //update tbl_sell_product popup end


    //start sell calculation//
    //getTotalSellValue();
    var sell_id;
    $('.sell_id').keyup(function () {
        sell_id = $(this).val();
        $('.hidden_sell_id').val(sell_id);
        getTotalSellValue();

    });
    function getTotalSellValue() { //for calculating the sales data

        $.ajax({
            url: 'functions2.php',
            method: 'post',
            data: {
                page: 'adsell',
                action: 'gettotal',
                customer_id: $('.customer_data_dropdown').val(),
                sell_id: $('.sell_id').val()
            },
            success: function (data) {
                $('.sell_subtotal').val(data);
            }, error: function (e) {

            }
        });


    } //end sell calculation//


    //start sell calculation

    $('.customer_balance,.customer_discount,.sell_dl,.sell_vat,.sell_paid').keyup(function () {
        sellCalculation();
    });

    function sellCalculation() {

        var customer_balance = $('.customer_balance').val();
        var sub_total = parseFloat($('.sell_subtotal').val());
        var discount = parseFloat($('.customer_discount').val());
        var vat = parseFloat($(".sell_vat").val());
        if (vat > 100) {
            vat = 0;
        }
        var dl = parseFloat($('.sell_dl').val());
        var x = (vat / 100);
        x = x * sub_total;
        var grandtotal = customer_balance - (sub_total + x + dl - discount);
        var paid = $('.sell_paid').val();
        $('.sell_grandtotal').val(grandtotal.toFixed(2));
        var due = grandtotal - paid;
        $('.sell_due').val(due.toFixed(2));
        if (due <= 0) {
            $('.sell_due').val(0);
        }
    }

    //end sell calculation


    //
    function showSellProducts(sell_id) {
        var cus_id = $(".customer_data_dropdown").val();
        $.ajax({
            url: 'functions2.php',
            data: {
                page: 'addsell',
                sell_id: sell_id,
                customer_id: cus_id,
                action: 'showsellproducts'
            },
            method: 'post',
            success: function (data) {
                $('.purchase_product_table tbody').html(data);
            }, error: function (e) {
                alert(e);
            }
        });
    }


    //function for individual product details
    function foo(product_id) {
        var result;
        $.ajax({
            url: "functions.php",
            method: 'get',
            data: {
                page: 'page',
                action: 'showproductbyid',
                product_id: product_id
            },
            dataType: 'json',
            success: function (data) {
                result = data;
            }, error: function (err) {
                alert(err);
            }, async: false
        });

        return result;
    }
    //showing several message and hide message
    setTimeout(function () {
        $('.fadeout').slideUp(500);
    }, 2000);

});
