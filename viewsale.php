<?php
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
?>
<?php
session_start();
date_default_timezone_set('Asia/Dhaka');
$sell_id = '';
include_once 'classes/DB.php';
include 'classes/Session.php';
include_once 'helper/Helper.php';
$db = new DB();
$help = new Helper();
if (isset($_GET['sell_id'])) {
    $sell_id = $_GET['sell_id'];
    
    $update_by = Session::get('userid');
    $check = $db->link->query("select * from tbl_sell where sell_id='$sell_id'");
    if ($check->num_rows > 0) {
        $stmt = $db->link->query("select * from tbl_sell join tbl_customer on tbl_sell.customer_id = tbl_customer.customer_id where tbl_sell.sell_id='$sell_id'") or die($db->link->error);
        if ($stmt) {
            $inv_data = $stmt->fetch_assoc();
        }
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Invoice ID-<?php echo $sell_id; ?></title>
        <style type="text/css">
            body{
                background: #565843;
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 14px;
            }
            .main{
                width: 900px;
                min-height: 1000px;
                padding-left: 50px;
                padding-right: 50px;

            }
            .header {

            }
            .header h1{
                margin: 0px;
            }
            .break{
                background: #DBDDE0;
                margin-top:0px;
                height: 7px;
            }
            .address{

            }
            .address h4{
                text-align: center;
                margin: 0px;
                padding: 4px;
            }
            .page_title{

            }
            .page_title h2{
                text-align: center;
            }
            .information{
                width: 100%;
            }
            .information_left{
                width: 50%;
                float: left;

            }
            .information_right{
                width: 50%;
                float: right;
            }
            .products_table{

            }
            .products_table table{
                width: 100%;
                border-collapse: collapse;
                border: 1px solid #000;
            }
            .products_table table tr{

            }
            .products_table table tr th{
                border: 1px solid #000;
            }
            .products_table table tr td{
                border: 1px solid #000;
                text-align: center;
            }
            .calculation{
                width: 100%;
                overflow: hidden;
            }
            .calculation_left{
                width: 50%;
                float: left;
            }
            .calculation_right{
                width: 50%;
                float: right;
            }
            .footer_singature{
                width: 100%;
                margin-top: 50px;
                overflow: hidden;
            }
            .first_part{
                width: 25%;
                float: left;
            }
            .second_part{
                width: 25%;
                float: left;
                padding-left: 110px;
            }
            .third_part{
                width: 25%;
                float: right;
            }

            .command_section{
                text-align: center;
                margin-top: 20px;
            }
            .command_section span{

            }
            .command_section span input{
                padding: 5px;
                width: 50px;
                height: 30px;
                display: inline-block;
            }
        </style>
    </head>
    <body>
        <div class="main"  style="padding:10px; background: #fff; margin-top:5px; border:1px solid #FFE2D3; margin:0 auto;">

            <div class="header">
                <h1 style="text-align: center;">Point of Sale &amp; Store</h1>
                <img src="">
            </div>
            <div class="break">
                <h1></h1>
            </div>
            <div class="address">
                <h4 >11/12 Demo Street, Dhaka City. 01750-TYTEYE/arifsofg@gmail.com</h4>

            </div>
            <div class="page_title">
                <h2>Bill/Invoice</h2>
            </div>
            
            <div class="information">
                <div class="information_left">
                    <table style="text-align: center;">
                        <tr>
                            <td>Invoice No</td>
                            <td>:</td>
                            <td><strong><?php echo $inv_data['sell_id']; ?></strong></td>

                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>:</td>
                            <td><?php echo $help->formatDate($inv_data['date'], $format = 'd-m-Y');  ?></td>

                        </tr>
                        <tr>
                            <td>Time</td>
                            <td>:</td>
                            <td><?php echo $help->formatDate($inv_data['date'], $format = 'H:i A');  ?></td>

                        </tr>
                        <tr>
                            <td>Seller</td>
                            <td>:</td>
                            <td><?php echo Session::get('name'); ?></td>

                        </tr>


                    </table>
                </div>
                <div class="information_right">
                    <table>
                        <tr>
                            <td>Customer ID</td>
                            <td>:</td>
                            <td><?php echo $inv_data['customer_id']; ?></td>

                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?php echo $inv_data['customer_name']; ?></td>

                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><?php echo $inv_data['address']; ?></td>

                        </tr>
                        <tr>
                            <td>Contact</td>
                            <td>:</td>
                            <td><?php echo $inv_data['contact_no']; ?></td>

                        </tr>


                    </table>
                </div>
            </div>

            <div class="products_table">
                <table cellpadding="3">
                    <thead>
                        <tr>
                            <th>SERIAL</th>
                            <th>PRODUCT NAME</th>
                            <th>GROUP</th>
                            <th>SIZE(HxW)</th>
                            <th>COLOR</th>
                            <th>PRICE</th>
                            <th>QUAT.</th>
                            <th>UNIT.</th>
                            <th>TOTAL</th>
                        </tr>	
                    </thead>
                    <tbody>
                        <?php
                        echo $sell_id = $inv_data['sell_id'];
                        echo $customer_id = $inv_data['customer_id'];
                        $update_q = "update tbl_sell_products set status = '1' where sell_id='$sell_id' and customer_id='$customer_id'";
                        $update_q_st = $db->link->query($update_q);
                        $q = "SELECT * FROM tbl_sell_products, tbl_product,tbl_group WHERE tbl_sell_products.product_id = tbl_product.product_id and tbl_sell_products.customer_id='$customer_id' and tbl_group.groupid = tbl_product.product_group and tbl_sell_products.sell_id='$sell_id' and tbl_sell_products.status='1' ORDER by tbl_sell_products.serial_no ASC";
                        $st = $db->link->query($q);
                        $i = 0;
                        $total = 0;
                        ?>
                        <?php if ($st): ?>

                            <?php while ($result = $st->fetch_assoc()): ?>
                                <?php
                                $i++;
                                $total += $result['subtotal'];
                                ?>
                                <tr>   
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $result['product_name']; ?></td>
                                    <td><?php echo $result['groupname']; ?></td>
                                    <td><?php echo $result['size_h'] . ' x ' . $result['size_w']; ?></td>
                                    <td><?php echo $result['color']; ?></td>
                                    <td><?php echo $result['price'] . ".00"; ?></td>
                                    <td><?php echo $result['quantity']; ?></td>
                                    <td><?php echo $result['unit_price']; ?></td>
                                    <td><?php echo $result['subtotal']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                            <tr>
                                <td colspan="8"  style="text-align: center"><span class="tab-1" style="text-align: center"><strong>Total </strong></td>
                                <td   style="text-align: center"><span class="tab-1" style="text-align: center"><strong>BDT: <?php echo $total; ?>/=</strong></td>
                            </tr>
                        <?php endif; ?>

                    </tbody>

                </table>
            </div>
            <div class="calculation">
                <div class="calculation_left">
                    <br/>
                    <table>
                        <tr>
                            <td>REMARK</td>
                            <td>:</td>
                            <td>10</td>

                        </tr>
                        <tr>
                            <td>IN WORDS</td>
                            <td>:</td>
                            <td>Somethong</td>

                        </tr>

                    </table>
                </div>
                <div class="calculation_right">

                    <table style="text-align: center;">
                        <tr>
                            <td>DL CHARGE</td>
                            <td>:</td>
                            <td><strong><?php echo $inv_data['dlcharge']; ?></strong></td>

                        </tr>
                        <tr>
                            <td>SUB TOTAL</td>
                            <td>:</td>
                            <td><?php echo $inv_data['sub_total']; ?></td>

                        </tr>
                        <tr>
                            <td>DISCOUNT(tk)</td>
                            <td>:</td>
                            <td><?php echo $inv_data['discount']; ?></td>

                        </tr>
                        <tr>
                            <td>VAT(%)</td>
                            <td>:</td>
                            <td><?php echo $inv_data ['vat']; ?></td>

                        </tr>
                        <tr>
                            <td><strong>GRAND TOTAL</strong></td>
                            <td>:</td>
                            <td><?php echo $inv_data['sub_total']; ?></td>

                        </tr>

                        <tr>
                            <td>PAID</td>
                            <td>:</td>
                            <td><?php echo $inv_data['paid']; ?></td>
                        </tr>
                        <tr>
                            <td>DUE</td>
                            <td>:</td>
                           <td><?php echo $inv_data['due']; ?></td>

                        </tr>
                      
                       <!--  <tr>
                            <td><strong>BALANCE</strong></td>
                            <td>:</td>
                            <td><?php //echo $_POST['balance']; ?></td>

                        </tr> -->



                    </table>
                </div>
            </div>
            <div class="footer_singature">

                <div class="first_part">
                    <hr/>
                    <p>Customer's Signature</p>
                </div>
                <div class="second_part">
                    <hr/>
                    <p>Delivery Incharge/Manager</p>
                </div>
                <div class="third_part">
                    <hr/>
                    <p>For Demo Point Sale Management</p>
                </div>
            </div>

            <div class="command_section">
                <span>
                    <a  href="addsell.php" id="backbutton">Sell Product</a>
                    <button class="printbutton" id="printbutton" onclick="printFunction()" style="background: #007fff; width: 100px; height: 30px;">Print</button>
                </span>
            </div>

        </div>
        <script>
            function printFunction() {
                var printButton = document.getElementById("printbutton");
                var backButton = document.getElementById('backbutton');
                backButton.style.visibility = 'hidden';
                printButton.style.visibility = 'hidden';
                window.print();
                printButton.style.visibility = 'visible';
                backButton.style.visibility = 'visible';
            }
        </script>
    </body>

</html>