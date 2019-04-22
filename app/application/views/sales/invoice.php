<?php $this->load->view("partial/header");?>

<?php
if (isset($error_message)) {
    echo "<div class='alert alert-dismissible alert-danger'>" . $error_message . "</div>";
    exit;
}
?>

<!-- Modal -->
<div class="modal" id="printWarning" tabindex="-1" role="dialog" aria-labelledby="printWarningLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printWarningLabel">Printer Settings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>Important</h3>
                <p>
                    To ensure the invoice is printed correctly, please ensure
                    the printer settings in the popup dialog are configured as follows:
                </p>
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Setting</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">2-Sided</th>
                            <td>Yes - Long Edge</td>
                        </tr>
                        <tr>
                            <th scope="row">Orientation</th>
                            <td>Portrait</td>
                        </tr>
                        <tr>
                            <th scope="row">Scaling</th>
                            <td colspan="2">85%</td>
                        </tr>
                        <tr>
                            <th scope="row">Headers/Footers</th>
                            <td colspan="2">Off</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="printdoc();" class="btn btn-primary">Print Invoice</button>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($customer_email)): ?>
<script type="text/javascript">
$(document).ready(function() {
    var send_email = function() {
        $.get('<?php echo site_url() . "/sales/send_pdf/" . $sale_id_num . '/invoice'; ?>',
            function(response) {
                $.notify(response.message, {
                    type: response.success ? 'success' : 'danger'
                });
            }, 'json'
        );
    };

    $("#show_email_button").click(send_email);

    <?php if (!empty($email_receipt)): ?>
    send_email();
    <?php endif;?>
});
</script>
<?php endif;?>

<?php $this->load->view('partial/print_receipt', array('print_after_sale' => $print_after_sale, 'selected_printer' => 'invoice_printer'));?>

<div class="print_hide al-right" id="control_buttons">
    <a data-toggle="modal" data-target="#printWarning">
        <div class="btn btn-info btn-sm" , id="show_print_button">
            <?php echo '<span class="glyphicon glyphicon-print">&nbsp</span>' . $this->lang->line('common_print'); ?>
        </div>
    </a>
    <?php echo anchor("sales/save_pdf/" . $sale_id_num . '/invoice', '<span class="glyphicon glyphicon-download">&nbsp</span>' . $this->lang->line('common_save_pdf'), array('class' => 'btn btn-info btn-sm', 'id' => 'show_save_button')); ?>
    <?php if (isset($customer_email) && !empty($customer_email)): ?>
    <a href="javascript:void(0);">
        <div class="btn btn-info btn-sm" , id="show_email_button">
            <?php echo '<span class="glyphicon glyphicon-envelope">&nbsp</span>' . $this->lang->line('sales_send_invoice'); ?>
        </div>
    </a>
    <?php endif;?>
    <?php echo anchor("sales", '<span class="glyphicon glyphicon-shopping-cart">&nbsp</span>' . $this->lang->line('sales_register'), array('class' => 'btn btn-info btn-sm', 'id' => 'show_sales_button')); ?>
    <?php echo anchor("sales/manage", '<span class="glyphicon glyphicon-list-alt">&nbsp</span>' . $this->lang->line('sales_takings'), array('class' => 'btn btn-info btn-sm', 'id' => 'show_takings_button')); ?>
</div>

<?php
// Temporarily loads the system language for _lang to print invoice in the system language rather than user defined.
load_language(true, array('sales', 'common'));
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
            <img id="image" class="cbv-invoice-logo"
                src="<?php echo base_url('uploads/' . $this->config->item('company_logo')); ?>" alt="company_logo" />
            <div>&nbsp</div>
            <div id="tax-invoice">TAX INVOICE</div>
        </div>
    </div>

    <div id="block2">

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
                    <?php echo $this->lang->line('sales_invoice_number'); ?>
                </td>
                <td><textarea rows="5" cols="6"><?php echo $invoice_number; ?></textarea></td>
            </tr>
            <tr>
                <td class="meta-head">
                    <?php echo $this->lang->line('common_date'); ?>
                </td>
                <td><textarea rows="5" cols="6"><?php echo $transaction_date; ?></textarea></td>
            </tr>
            <tr>
                <td class="meta-head">
                    <?php echo $this->lang->line('sales_amount_due'); ?>
                </td>
                <td><textarea rows="5" cols="6"><?php echo to_currency($total); ?></textarea></td>
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
            <th>
                <?php echo $this->lang->line('sales_total'); ?>
            </th>
        </tr>

        <?php
foreach ($cart as $line => $item) {

    if ($item['item_category'] == "Laptop" || $item['item_category'] === "Desktop") { // if the item is a desktop or laptop

        $item['name'] = "CBV " . $item['name'] . " (" . $item['item_category'] . ")"; // change the name to "CBV XXXX (Type)"

    } else {
        $item['name'] = ucfirst($item['name']); // otherwise just use the name
    }

    ?>
        <tr class="item-row">
            <td colspan="2" class="item-name"><textarea rows="4" cols="6"><?php echo $item['name']; ?></textarea></td>
            <td><textarea rows="4" cols="4"><?php echo to_currency($item['price']); ?></textarea></td>
            <td style='text-align:center;'><textarea rows="5"
                    cols="6"><?php echo to_quantity_decimals($item['quantity']); ?></textarea></td>
            <td><textarea rows="4" cols="6"><?php echo to_currency($item['total']); ?></textarea></td>
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
            <td colspan="1" class="total-line al-right">
                <?php echo $this->lang->line('sales_sub_total'); ?></td>
            <td class="total-value al-right">
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
            <td class="total-value"><?php echo to_currency($payment['payment_amount'] * -1); ?></td>
        </tr>
        <?php
}
?>
        <tr>
            <td colspan="3" class="blank"> </td>
            <td colspan="1" class="total-line al-right">
                <?php echo $this->lang->line('sales_amount_due'); ?></td>
            <td class="total-value"><?php echo to_currency($amount_change * -1); ?></td>
        </tr>
    </table>

    <div id="terms">
        <div id="sale_return_policy">
            <h5>
                <!-- To keep things clean and as we dont really use these fields, hiding if they are empty -->
                <?php if (!empty($this->config->item('payment_message'))) {?><textarea rows="5"
                    cols="6"><?php echo nl2br($this->config->item('payment_message')); ?></textarea> <?php }?>
                <?php if (!empty($comments)) {?><textarea rows="5"
                    cols="6"><?php echo empty($comments) ? '' : $this->lang->line('sales_comments') . ': ' . $comments; ?></textarea>
                <?php }?>
                <?php if (!empty($this->config->item('invoice_default_comments'))) {?><textarea rows="5"
                    cols="6"><?php echo $this->config->item('invoice_default_comments'); ?></textarea> <?php }?>
            </h5>
            <?php echo nl2br($this->config->item('return_policy')); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
$(window).on("load", function() {
    // install firefox addon in order to use this plugin
    if (window.jsPrintSetup) {
        <?php if (!$this->Appconfig->get('print_header')) {
    ?>
        // set page header
        jsPrintSetup.setOption('headerStrLeft', '');
        jsPrintSetup.setOption('headerStrCenter', '');
        jsPrintSetup.setOption('headerStrRight', '');
        <?php
}

if (!$this->Appconfig->get('print_footer')) {
    ?>
        // set empty page footer
        jsPrintSetup.setOption('footerStrLeft', '');
        jsPrintSetup.setOption('footerStrCenter', '');
        jsPrintSetup.setOption('footerStrRight', '');
        <?php
}
?>
    }
});
</script>

<?php $this->load->view("partial/footer");?>