<?php
// Temporarily loads the system language for to print receipt in the system language rather than user defined.
load_language(true, array('customers', 'sales', 'employees'));
?>

<div id="page-wrap">



    <div id="block1">
        <div id="customer-title">
            <?php
if (isset($customer)) {
    ?>
            <textarea id="customer" rows="4" cols="6"><?php echo $customer_info ?></textarea>
            <?php
}
?>
        </div>


        <div id="logo">
            <img id="image" class="cbv-invoice-logo" src="<?php echo base_url('images/cbv-logo-black.png'); ?>"
                alt="company_logo" />
            <div>&nbsp</div>
            <div id="tax-invoice">TAX INVOICE</div>
        </div>
    </div>


    <div id="block2" class="block2r">

        <?php
if ($this->Appconfig->get('receipt_show_company_name')) {
    ?>
        <div id="company_name">
            <?php echo $this->config->item('company'); ?>
        </div>
        <?php
}
?>

        <textarea id="company-title" rows="5" cols="35"><?php echo $company_info ?></textarea>
        <table id="meta">
            <tr>
                <td class="meta-head">
                    <?php echo $this->lang->line('sales_id') ?>
                </td>
                <td><textarea rows="5" cols="6"><?php echo $sale_id; ?></textarea></td>
            </tr>
            <?php
if (!empty($invoice_number)) {
    ?>
            <tr>
                <td class="meta-head">
                    <?php echo $this->lang->line('sales_invoice_number') ?>
                </td>
                <td><textarea rows="5" cols="6"><?php echo $invoice_number; ?></textarea></td>
            </tr>
            <?php
}
?>
            <tr>
                <td class="meta-head">
                    <?php echo $this->lang->line('sales_receipt'); ?>
                </td>
                <td><textarea rows="5" cols="6"><?php echo $transaction_time ?></textarea></td>
            </tr>
        </table>
    </div>


    <table id="items">

        <tr>
            <th colspan="2">
                <?php echo $this->lang->line('sales_item_name'); ?>
            </th>
            <th>
                <?php echo $this->lang->line('sales_price'); ?>
            </th>
            <th>
                <?php echo $this->lang->line('sales_quantity'); ?>
            </th>
            <th class="total-value">
                <?php echo $this->lang->line('sales_total'); ?>
            </th>
        </tr>

        <?php
foreach ($cart as $line => $item) {

    if ($item['item_category'] == 'Laptop' || $item['item_category'] == 'Desktop') { // if the item is a desktop or laptop

        $itemName = 'CBV ' . $item['name'] . ' (' . $item['item_category'] . ')'; // change the name to "CBV XXXX (Type)"

    } else {
        $itemName = ucfirst($item['name']); // otherwise just use the name
    }

    ?>

        <tr class="item-row">
            <td colspan="2" class="item-name"><textarea rows="4" cols="6"><?php echo $itemName ?></textarea></td>
            <td style='text-align:center;'><textarea rows="5"
                    cols="6"><?php echo to_currency($item['price']); ?></textarea></td>
            <td><textarea rows="4" cols="4"><?php echo to_quantity_decimals($item['quantity']); ?></textarea></td>
            <td class="" style=''><textarea rows="4"
                    cols="6"><?php echo to_currency($item[($this->config->item('receipt_show_total_discount') ? 'total' : 'discounted_total')]); ?></textarea>
            </td>
        </tr>
        <tr class="item-row"
            <?php echo !($item['item_category'] == "Laptop" || $item['item_category'] == "Desktop") ? 'style="display:none"' : '' ?>>
            <td class="item-description" colspan="5">
                <div><b>Machine Specs:</b> <?php echo $item['description']; ?></div>
            </td>
        </tr>
        <?php
if ($item['discount'] > 0) {
        ?>
        <tr>
            <td colspan="3" class="blank"> </td>
            <td colspan="1" class="blank disc">
                $<?php echo number_format($item['discount'], 2) . ' ' . $this->lang->line('sales_discount'); ?></td>
            <td class="total-line"><?php echo to_currency($item['discounted_total']); ?></td>
        </tr>
        <?php
}
}
?>

        <tr>
            <td class="blank" colspan="5" text-align="center">
                <?php echo '&nbsp;'; ?>
            </td>
        </tr>

        <?php
if ($this->config->item('receipt_show_total_discount') && $discount > 0) {
    ?>
        <tr>
            <td colspan="3" class="blank"> </td>
            <td colspan="1" class="total-line al-right" style='border-top:2px solid #000000;'>
                <?php echo $this->lang->line('sales_sub_total'); ?></td>
            <td class="total-value al-right" style=';border-top:2px solid #000000;'>
                <?php echo to_currency($prediscount_subtotal); ?></td>
        </tr>
        <tr>
            <td colspan="3" class="blank"> </td>
            <td colspan="1" class="total-line al-right"><?php echo $this->lang->line('sales_customer_discount'); ?></td>
            <td class="total-value"><?php echo to_currency($discount * -1); ?></td>
        </tr>
        <?php
}
?>

        <?php
if ($this->config->item('receipt_show_taxes')) {
    ?>
        <tr>
            <td colspan="3" class="blank"> </td>
            <td colspan="1" class="total-line al-right">
                <?php echo $this->lang->line('sales_sub_total'); ?></td>
            <td class="total-value al-right"><?php echo to_currency($subtotal); ?>
            </td>
        </tr>
        <?php

    if (empty($taxes)) { //if the taxes array is empty then show an empty "GST 10%    $0.00" line per request
        ?>


        <tr>
            <td colspan="3" class="blank"> </td>
            <td colspan="1" class="total-line" style='text-align:right;'>GST 10%</td>
            <td class="total-value"><?php echo to_currency(0); ?></td>
        </tr>

        <?php

    } else {

        foreach ($taxes as $tax_group_index => $sales_tax) {
            ?>
        <tr>
            <td colspan="3" class="blank"> </td>
            <td colspan="1" class="total-line" style='text-align:right;'><?php echo $sales_tax['tax_group']; ?></td>
            <td class="total-value"><?php echo to_currency_tax($sales_tax['sale_tax_amount']); ?></td>
        </tr>
        <?php
}
    }

    ?>


        <?php
}
?>

        <tr>
        </tr>

        <?php $border = (!$this->config->item('receipt_show_taxes') && !($this->config->item('receipt_show_total_discount') && $discount > 0));?>
        <tr>
            <td colspan="3" class="blank"> </td>
            <td colspan="1" class="total-line"
                style="text-align:right;<?php echo $border ? 'border-top: 2px solid black;' : ''; ?>">
                <?php echo $this->lang->line('sales_total'); ?></td>
            <td class="total-value"
                style="text-align:right;<?php echo $border ? 'border-top: 2px solid black;' : ''; ?>">
                <?php echo to_currency($total); ?></td>
        </tr>

        <tr>
            <td colspan="3" class="blank"> </td>
            <td colspan="2">&nbsp;</td>

        </tr>

        <?php
foreach ($payments as $payment_id => $payment) {
    $splitpayment = explode(':', $payment['payment_type']);
    ?>
        <tr>
            <td colspan="3" class="blank"> </td>
            <td colspan="1" style="text-align:right;" class="total-line"><?php echo $splitpayment[0]; ?> </td>
            <td class="total-value"><?php echo to_currency($payment['payment_amount'] * -1); ?></td>
        </tr>
        <?php
}
?>

        <tr>
            <td colspan="3" class="blank"> </td>
            <td colspan="1" style="text-align:right;" class="total-line">
                <?php echo $this->lang->line('sales_amount_due'); ?></td>
            <td class="total-value"><?php echo to_currency($amount_change * -1); ?></td>
        </tr>
    </table>

    <div id="sale_return_policy" style="">
        <?php echo nl2br($this->config->item('return_policy')); ?>
    </div>


    <!-- routine for inserting extra info like passwords, for PC and Laptop sales -->
    <?php

function isComputer($cats, $array) // input is list to search (arr) and the arr of items in cart

{
    foreach ($cats as &$value) {
        if (in_array($value, array_column($array, 'item_category'))) {
            return true;
            break; // exit loop on first match
        }
    }
}

if (($total > 0) && isComputer(array("Laptop", "Desktop"), $cart)) { // search value in the array only if its a sale

    echo '<div class="Thankyou-Note">' . $this->lang->line('sales_receipt_extra_page_note') . '</div>';
    echo '<div class="pagebreak"></div>';

    define('incKey', true);
    include 'user-info.php'; // in ./public/

} else {

    echo '<div class="Thankyou-Note">' . $this->lang->line('sales_receipt_thank_you') . '</div>';

}

?>

</div>