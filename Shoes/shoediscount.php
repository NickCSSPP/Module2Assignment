<?php
    // capture data from the form
    $product_description = filter_input(INPUT_POST, 'product_description');
    $list_price = filter_input(INPUT_POST, 'list_price', FILTER_VALIDATE_FLOAT);
    $discount_percent = filter_input(INPUT_POST, 'discount_percent', FILTER_VALIDATE_INT);
    $local_tax = filter_input(INPUT_POST, 'local_tax', FILTER_VALIDATE_INT);
    $sales_tax = filter_input(INPUT_POST, 'sales_tax', FILTER_VALIDATE_INT);

    //validate data
    $error_message = ''; //baseline value
    if (empty($product_description)){
        $error_message .= 'Shoe name is a required field.<br>';
    }

    //validate list price
    if ($list_price === FALSE) {
        $error_message .= 'List Price must be a valid number.<br>';
    }else if ($list_price <= 0) {
        $error_message .= 'List Price must be greater than 0.<br>';
    }
        

    //validate discount percent
    if ($discount_percent === FALSE) {
        $error_message .= 'Discount Percent must be a valid whole number.<br>';
    }else if ($discount_percent <= 0) {
        $error_message .= 'Discount Percent must be greater than 0.<br>';
    }

    //validate local tax
    if ($local_tax === FALSE) {
        $error_message .= 'Local Tax must be a valid whole number.<br>';
    }

    //validate state tax
    if ($sales_tax === FALSE) {
        $error_message .= 'Sales Tax must be a valid whole number.<br>';
    }

    if ($error_message != '') {
        include('main.php');
        exit();
    }
    

    //Calculate discount
    $discount = $list_price * $discount_percent * .01;
    $discount_price = $list_price - $discount;

    //Calculate State Tax
    $sales_tax_calculated = $discount_price * $sales_tax * .01;

    //Calculate Local Tax
    $local_tax_calculated = $discount_price * $local_tax * .01;

    //Identify sales total
    $sales_total = $discount_price + $sales_tax_calculated + $local_tax_calculated;

    //formatting
    $list_price_formatted = "$".number_format($list_price, 2);
    $discount_percent_formatted = $discount_percent."%";
    $discount_formatted = "$".number_format($discount, 2);
    $discount_price_formatted = "$".number_format($discount_price, 2);
    $sales_tax_percent_formatted = $sales_tax."%";
    $sales_tax_formatted = "$".number_format($sales_tax_calculated, 2);
    $local_tax_percent_formatted = $local_tax."%";
    $local_tax_formatted = "$".number_format($local_tax_calculated, 2);
    $sales_total_formatted = "$".number_format($sales_total, 2);
    
?>
<html>
    <head>
        <title>Shoe Discounts</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <main>
            <h1>Shoe Discount</h1>

            <label>Shoe Name:</label>
            <span><?php echo htmlspecialchars($product_description); ?></span><br>

            <label>List Price:</label>
            <span><?php echo htmlspecialchars($list_price_formatted); ?></span><br>

            <label>Standard Discount:</label>
            <span><?php echo htmlspecialchars($discount_percent_formatted); ?></span><br>

            <label>Discount Amount:</label>
            <span><?php echo htmlspecialchars($discount_formatted); ?></span><br>

            <label>Discount Price:</label>
            <span><?php echo htmlspecialchars($discount_price_formatted); ?></span><br>

            <br>

            <label>Sales Tax Rate:</label>
            <span><?php echo htmlspecialchars($sales_tax_percent_formatted); ?></span><br>

            <label>Sales Tax Amount:</label>
            <span><?php echo htmlspecialchars($sales_tax_formatted); ?></span><br>

            <label>Local Tax Rate:</label>
            <span><?php echo htmlspecialchars($local_tax_percent_formatted); ?></span><br>

            <label>Local Tax Amount:</label>
            <span><?php echo htmlspecialchars($local_tax_formatted); ?></span><br>

            <label>Total Price:</label>
            <span><?php echo htmlspecialchars($sales_total_formatted); ?></span><br>
        </main>
    </body>
</html>

