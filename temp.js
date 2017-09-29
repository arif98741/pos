function insertInvoicedata() {
    var x = 1;
    $('.add_invoice_btn').click(function () {

        var invoice_data = {
            invoice_number: $('#invoice_number').val(),
            time: $('#time_input').val(),
            date: $('#date_input').val()
        }

        if (invoice_data.invoice_number === '' || invoice_data.time === '' || invoice_data.date === '') {
            alert('Field Must Not Be Empty');
            return false;
        } else {

            var append = "<tr><td class='append_id" + x + "' suplier-id='' id='product_insert'><input class='form-control product_form_id" + x + "' supplier-id='" + x + "' id='product_insert' placeholder='Enter Product ID'></td></tr>";
            $('#invoice_product_data_table tbody:last-child').append(append);

            $('.product_form_id' + x).mouseout(function () {
                var product_id = $(this).val();
                $.ajax({
                    url: 'functions.php',
                    method: 'get',
                    dataType: 'json',
                    data: {page: "product", product_id: product_id},
                    success: function (data) {
                        console.log(data);

                        var appenddata = "<td>" + data['product_name'] + "</td>";
                        appenddata += "<td>" + data['typename'] + "</td>";
                        appenddata += "<td>" + data['groupname'] + "</td>";
                        appenddata += "<td>" + data['size_h'] + "</td>";
                        appenddata += "<td>" + data['size_w'] + "</td>";
                        appenddata += '<td style="' + "text-align:center;" + '"><input type="text" class="form-control"></td>';
                        appenddata += '<td><input type="text" class="form-control"></td>';
                        appenddata += '<td><input type="text" class="form-control"></td>';
                        appenddata += '<td><input type="text" class="form-control"></td>';
                        appenddata += '<td><input type="text" class="form-control"></td>';
                        appenddata += '<td><input type="text" class="form-control"></td>';
                        appenddata += '<td><i class="fa fa-check btn">&nbsp;&nbsp;<i class="fa fa-trash"><i/></td>';
                        $('.invoice_table tbody tr:last-of-type').append(appenddata);
                        return false;
                    }, error: function () {

                    }
                });
            });
            x++;
            return false;
        }
    });
}