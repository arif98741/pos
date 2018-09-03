<?php include 'lib/header.php'; ?>

<div class="container">
    <div class="content_section">
        <div class="panel">
            <div class="panel-heading page_info">
                <ol class="breadcrumb bg-info">
                    <li><a href="#" class="active"><i class="fa fa-home"></i>&nbsp;Home/</a></li>
                </ol>
            </div>
        </div>   

        <div class="col-md-4 summary_block">

            <h2>Today Sell </h2>
            <h3 class="text-left"><?php echo $dash->TodaySale(); ?></h3>

           <!--  <h1 class="sell_product_time">56</h1> -->

        </div>
        <div class="col-md-4 summary_block">
            <h2>Today Memo</h2>
            <h3 class="text-left"><?php echo $dash->TodayMemo(); ?></h3>
            
        </div>
        <div class="col-md-4 summary_block">
            <h2>Total Customer</h2>
            <h3 class="text-left"><?php echo $dash->totalCustomers(); ?></h3>

        </div>
        <div class="col-md-4 summary_block">
            
            <h2>Total Products</h2>
            <h3 class="text-left"><?php echo $dash->totalProducts(); ?></h3>

        </div>
        <div class="col-md-4 summary_block">
            
             <h2>Total Supplier</h2>
            <h3 class="text-left"><?php echo $dash->totalSuppliers(); ?></h3>



        </div>


    </div>

    <?php include 'lib/footer.php'; ?>