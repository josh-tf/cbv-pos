<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'css/invoice_email.css'; ?>" />
</head>

<body>
    <?php
if (isset($error_message)) {
    echo "<div class='alert alert-dismissible alert-danger'>" . $error_message . "</div>";
    exit;
}

// Temporarily loads the system language for _lang to print invoice in the system language rather than user defined.
load_language(true, array('sales', 'common'));
?>

    <div id="page-wrap">
        <table id="info">
            <tr>
                <td id="logo">
                    <img class="cbv-invoice-logo" src="<?php echo base_url('uploads/' . $this->config->item('company_logo')); ?>"
                        alt="company_logo" />
                    <div id="tax-invoice">TAX INVOICE</div>
                </td>
                <td id="customer-title">
                    <pre class="customer-info"><?php if (isset($customer)) {echo $customer_info;}?></pre>
                </td>
            </tr>
            <tr>
                <td id="company-title">
                    <h3><?php echo $this->config->item('company'); ?></h3>
                    <pre><?php echo $company_info; ?></pre>
                </td>
                <td id="meta">
                    <table align="right" class="invoice-meta">
                        <tr>
                            <td class="meta-head"><?php echo $this->lang->line('sales_invoice_number'); ?> </td>
                            <td>
                                <div><?php echo $invoice_number; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="meta-head"><?php echo $this->lang->line('common_date'); ?></td>
                            <td>
                                <div><?php echo $transaction_date; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="meta-head"><?php echo $this->lang->line('sales_amount_due'); ?></td>
                            <td>
                                <div class="due"><?php echo to_currency($total); ?></div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table id="items">
            <tr>
                <th colspan="2"><?php echo $this->lang->line('sales_item_name'); ?></th>
                <th><?php echo $this->lang->line('sales_quantity'); ?></th>
                <th><?php echo $this->lang->line('sales_price'); ?></th>
                <th><?php echo $this->lang->line('sales_total'); ?></th>
            </tr>

            <?php
foreach ($cart as $line => $item) {

    if ($item['item_category'] == 'Laptop' || $item['item_category'] == 'Desktop') { // if the item is a desktop or laptop

        $item['name'] = 'CBV ' . $item['name'] . ' (' . $item['item_category'] . ')'; // change the name to "CBV XXXX (Type)"

    } else {
        $item['name'] = ucfirst($item['name']); // otherwise just use the name
    }

    ?>
            <tr class="item-row">
                <td colspan="2" class="item-name"><?php echo $item['name']; ?></td>
                <td><?php echo to_quantity_decimals($item['quantity']); ?></td>
                <td><?php echo to_currency($item['price']); ?></td>
                <td class="total-line"><?php echo to_currency($item['total']); ?></td>
            </tr>
            <tr class="item-row" <?php echo !($item['item_category'] == "Laptop" || $item['item_category'] == "Desktop") ? 'style="display:none"' : '' ?>>
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
            <td colspan="1" class="total-line al-right">
                <?php echo $this->lang->line('sales_sub_total'); ?></td>
            <td class="total-value al-right">
                <?php echo to_currency($prediscount_subtotal); ?></td>
        </tr>
        <tr>
            <td colspan="3" class="blank"> </td>
            <td colspan="1" class="total-line al-right"><?php echo $this->lang->line('sales_customer_discount'); ?></td>
            <td class="total-value al-right"><?php echo to_currency($discount * -1); ?></td>
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
            <td colspan="1" class="total-line al-right"><?php echo $this->lang->line('sales_tax_default'); ?></td>
            <td class="total-value al-right"><?php echo to_currency(0); ?></td>
        </tr>

        <?php

    } else {

        foreach ($taxes as $tax_group_index => $sales_tax) {
            ?>
        <tr>
            <td colspan="3" class="blank"> </td>
            <td colspan="1" class="total-line al-right"><?php echo $sales_tax['tax_group']; ?></td>
            <td class="total-value al-right"><?php echo to_currency_tax($sales_tax['sale_tax_amount']); ?></td>
        </tr>
        <?php
}
    }

    ?>


        <?php
}
?>

        <?php $border = (!$this->config->item('receipt_show_taxes') && !($this->config->item('receipt_show_total_discount') && $discount > 0));?>
        <tr>
            <td colspan="3" class="blank"> </td>
            <td colspan="1" class="total-line al-right">
                <?php echo $this->lang->line('sales_total'); ?></td>
            <td class="total-value al-right">
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
            <td colspan="1" class="total-line al-right"><?php echo $splitpayment[0]; ?> </td>
            <td class="total-value al-right"><?php echo to_currency($payment['payment_amount'] * -1); ?></td>
        </tr>
        <?php
}
?>
        <tr>
            <td colspan="3" class="blank"> </td>
            <td colspan="1" class="total-line al-right">
                <?php echo $this->lang->line('sales_amount_due'); ?></td>
            <td class="total-value al-right"><?php echo to_currency($amount_change * -1); ?></td>
        </tr>
    </table>

        <div id="terms">
            <div id="sale_return_policy">

                <div class="inv-comments">

                    <?php echo (empty($comments) ? $this->config->item('invoice_default_comments') : $comments); ?>
                </div>

                <?php echo nl2br($this->config->item('return_policy')); ?>

            </div>
        </div>

</body>

</html>