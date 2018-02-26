<?php
$sell_id;
$filepath = realpath(dirname(__DIR__));
session_start();
if ($_SESSION['login'] == false) {
    header('location: index.php');
}
include_once 'classes/DB.php';
include_once 'helper/Helper.php';
$db = new DB();
$help = new Helper();
if (isset($_GET['sell_id'])) {
    $sell_id = $_GET['sell_id'];
    $sales_query = "SELECT * FROM tbl_sell_products,tbl_sell,tbl_product where tbl_sell_products.sell_id = tbl_sell.sell_id and tbl_sell_products.product_id = tbl_product.product_id AND tbl_sell.sell_id ='$sell_id' and tbl_sell_products.status = '0'  ORDER by tbl_sell_products.serial_no DESC";
    $sales_st = $db->link->query($sales_query);
    if ($sales_st) {
        $rr = $sales_st->fetch_assoc();
    }
} else {
    header('location: addsell.php');
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sales Invoice-<?php echo $sell_id; ?></title>
        <link rel="stylesheet" href="assets/css/printstyle.css" type="text/css" media="screen">
        <link rel="stylesheet" href="assets/css/print.css" type="text/css" media="print">
        <style type="text/css">
            body {
                background: url(img/footer-bg.png) #d6a370;
                zoom: 90%;
            }

        </style>
    </head>
    <body>

        <div class="main" style="padding:10px; background:#fff; margin-top:5px; border:1px solid #FFE1D2D3; width:900px; margin:0 auto;">
            <div class="exam-year">
                <div class="header_result">
                    <div class="logo"><a href="index.php"><img src="img/govlogo.png" width="70" height="70" align="center" alt=""/></a><span class="header-text-result"><br>
                            Didar Tyles and Sanitary</span><span class="header-text-2-result"><br>
                            Laxmipur Sadar, Laxmipur</div>
                            <div class="header-text">
                                <div class="marks">
                                    <div class="header-text-2"></div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="exam-year">
                    <div class="red-1"></div>
                    <br>
                    Sales Page<br>
                </div>
                <hr>
                <table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#fff" bgcolor="#fff" class="Mtable">
                    <tr>
                        <td width="49%" height="22" align="right" bgcolor="#DEE1E4"  >Customer Name </td>
                        <td width="3%" align="center" valign="middle" bgcolor="#DEE1E4" >: </td>
                        <th width="48%" height="22" align="left" bgcolor="#DEE1E4" ><?php echo $rr['customer_id']; ?></th>
                    </tr>
                    <tr>
                        <td height="22" align="right" bgcolor="#DEE1E4"  >Date </td>
                        <td height="22" align="center" valign="middle" bgcolor="#DEE1E4" >: </td>
                        <th height="22" align="left" bgcolor="#DEE1E4" ><?php echo $help->formatDate($rr['date'], 'd-m-Y g:iA'); ?> </th>
                    </tr>
                    <tr>
                        <td height="22" align="right" bgcolor="#DEE1E4" >Seller </td>
                        <td height="22" align="center" valign="middle" bgcolor="#DEE1E4" >: </td>
                        <th height="22" align="left" bgcolor="#DEE1E4" ><?php echo $_SESSION['name']; ?> </th>
                    </tr>
                    <tr>
                        <td height="22" align="right" bgcolor="#DEE1E4" >Total </td>
                        <td height="22" align="center" valign="middle" bgcolor="#DEE1E4" >: </td>
                        <th height="22" align="left" bgcolor="#DEE1E4" >125.45 </th>
                    </tr>
                    <tr>
                        <td height="22" align="right" bgcolor="#DEE1E4" >Paid </td>
                        <td height="22" align="center" valign="middle" bgcolor="#DEE1E4" >: </td>
                        <th height="22" align="left" bgcolor="#DEE1E4" >457.35 </th>
                    </tr>
                    <tr>
                        <td height="22" align="right" bgcolor="#DEE1E4" >Due </td>
                        <td height="22" align="center" valign="middle" bgcolor="#DEE1E4" >: </td>
                        <th height="22" align="left" bgcolor="#DEE1E4" >457.35 </th>
                    </tr>

                </table>
                <div class="marks"> <br>
                    PRODUCT NAME &amp; DETAILS

                </div>

                <hr>
                <br>
                <table width="100%" border="1" cellpadding="1" cellspacing="0" bgcolor="#fff" bordercolor="#ccc" class="tb-f">
                    <tr>
                        <th width="5%" height="22" bgcolor="#afb7be" style="text-align: center">SERIAL</th>
                        <th width="15%" height="22" bgcolor="#afb7be" style="text-align: center">PRODUCT ID</th>
                        <th width="25%" height="22" bgcolor="#afb7be" class="tab-1-2" style="text-align: center">PRODUCT NAME</th>
                        <th width="10%" height="22" bgcolor="#afb7be" class="tab-1-2" style="text-align: center">QUANTITY</th>
                        <th width="10%" height="22" bgcolor="#afb7be" class="tab-1-2" style="text-align: center">PIECE</th>
                        <th width="15%" height="22" bgcolor="#afb7be" class="tab-1-2" style="text-align: center">UNIT PRICE</th>
                        <th width="20%" height="22" bgcolor="#afb7be" class="tab-1-2" style="text-align: center">SUB TOTAL</th>

                    </tr>
                    <?php
                    $q = "SELECT * FROM tbl_sell_products,tbl_sell,tbl_product where tbl_sell_products.sell_id = tbl_sell.sell_id and tbl_sell_products.product_id = tbl_product.product_id AND tbl_sell.sell_id ='$sell_id' and tbl_sell_products.status = '0'  ORDER by tbl_sell_products.serial_no DESC";
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
                                <td height="22" bgcolor="#EEEEEE" style="text-align: center"><span class="tab-1" style="text-align: center"><?php echo $i; ?> </td>
                                <td height="22" bgcolor="#EEEEEE" style="text-align: center"><span class="tab-1" style="text-align: center"><?php echo $result['product_id']; ?> </td>
                                <td height="22" bgcolor="#EEEEEE" class="tab-1-2" style="text-align: center"><span class="tab-1" style="text-align: center"><?php echo $result['product_name']; ?> </td>
                                <td height="22" bgcolor="#EEEEEE" class="tab-1-2" style="text-align: center"><span class="tab-1" style="text-align: center"><?php echo $result['quantity']; ?></td>
                                <td height="22" bgcolor="#EEEEEE" style="text-align: center"><span class="tab-1" style="text-align: center"><?php echo $result['product_piece']; ?> </td>
                                <td height="22" bgcolor="#EEEEEE" style="text-align: center"><span class="tab-1" style="text-align: center"><?php echo $result['unit_price']; ?> </td>
                                <td height="22" bgcolor="#EEEEEE" class="tab-1-2" style="text-align: center"><span class="tab-1" style="text-align: center"><?php echo $result['subtotal']; ?> </td>

                            </tr>
                        <?php endwhile; ?>
                        <tr>
                            <td colspan="6" height="22" bgcolor="#EEEEEE" class="tab-1-2" style="text-align: center"><span class="tab-1" style="text-align: center"><strong>Total </strong></td>
                            <td height="22" bgcolor="#EEEEEE" class="tab-1-2" style="text-align: center"><span class="tab-1" style="text-align: center"><?php echo $total; ?> </td>
                        </tr>
                    <?php endif; ?>

                </table>
                <br>
                <br>
                <div class="serarch-again"><a href="addsell.php" class="button">Back</a>
                    <INPUT TYPE="button" class="button green" title="Print" onClick="window.print()" value="Print">
                </div>
                <div class="footer-1">
                    <table width="100%" border="0" class="footer-text">
                        <tr>
                            <td height="42" align="center" valign="middle" nowrap="nowrap" class="footer-text"> ©2015 LAXMIPUR GOVT COLLEGE, All rights reserved.<br>
                                <a href="http://exploreit.com.bd" target="_blank"><strong>Technical Assistant: explroeit.com.bd</strong></a></td>
                        </tr>
                    </table>
                </div>
            </div>
    </body>
</html>
