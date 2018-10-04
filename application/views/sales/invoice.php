<?php $this->load->view("partial/header");?>

<?php
if (isset($error_message)) {
    echo "<div class='alert alert-dismissible alert-danger'>" . $error_message . "</div>";
    exit;
}
?>

<?php if (!empty($customer_email)): ?>
<script type="text/javascript">
	$(document).ready(function () {
		var send_email = function () {
			$.get('<?php echo site_url() . "/sales/send_pdf/" . $sale_id_num; ?>',
				function (response) {
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

<div class="print_hide" id="control_buttons" style="text-align:right">
	<a href="javascript:printdoc();">
		<div class="btn btn-info btn-sm" , id="show_print_button">
			<?php echo '<span class="glyphicon glyphicon-print">&nbsp</span>' . $this->lang->line('common_print'); ?>
		</div>
	</a>
	<?php /* this line will allow to print and go back to sales automatically.... echo anchor("sales", '<span class="glyphicon glyphicon-print">&nbsp</span>' . $this->lang->line('common_print'), array('class'=>'btn btn-info btn-sm', 'id'=>'show_print_button', 'onclick'=>'window.print();')); */?>
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
	<!-- <div id="header"> // hiding this element as 'Tax Invoice' is present under the logo
		<?php echo $this->lang->line('sales_invoice'); ?>
	</div> -->

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
			<img id="image" class="cbv-invoice-logo" src="<?php echo base_url('images/cbv-logo-black.png'); ?>" alt="company_logo" />
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
					Invoice Total
				</td>
				<td><textarea rows="5" cols="6"><?php echo to_currency($total); ?></textarea></td>
			</tr>
		</table>
	</div>

	<table id="items">
		<tr>
			<th>
				<?php echo $this->lang->line('sales_item_name'); ?>
			</th>
			<th>
				<?php echo $this->lang->line('sales_quantity'); ?>
			</th>
			<th>
				<?php echo $this->lang->line('sales_price'); ?>
			</th>
			<th>
				Discount
			</th>
			<th>
				<?php echo $this->lang->line('sales_total'); ?>
			</th>
		</tr>

		<?php
foreach ($cart as $line => $item) {

    if ($item['item_category'] == "Laptop" || $item['item_category'] === "Desktop") { // if the item is a desktop or laptop

        $itemName = "CBV " . $item['name'] . " (" . $item['item_category'] . ")"; // change the name to "CBV XXXX (Type)"

    } else {
        $itemName = ucfirst($item['name']); // otherwise just use the name
    }

    ?>
		<tr class="item-row">
			<td class="item-name"><textarea rows="4" cols="6"><?php echo $itemName; ?></textarea></td>
			<td style='text-align:center;'><textarea rows="5" cols="6"><?php echo to_quantity_decimals($item['quantity']); ?></textarea></td>
			<td><textarea rows="4" cols="4"><?php echo to_currency($item['price']); ?></textarea></td>
			<td style='text-align:center;'><textarea rows="4" cols="6">$<?php echo number_format($item['discount'], 2); ?></textarea></td>
			<td style='border-right: solid 1px; text-align:right;'><textarea rows="4" cols="6"><?php echo to_currency($item['discounted_total']); ?></textarea></td>
		</tr>
		<?php
if ($this->config->item('receipt_show_description') && !empty($item['description'])) {
        ?>
		<tr class="item-row">
			<td class="item-description" colspan="5">
				<div>

					<?php

				if ($item['item_category'] == "Laptop" || $item['item_category'] === "Desktop") {

					echo '<b>Machine Specs:</b> ' . $item['description'];

				} else {

					echo  $item['description'];
				}
				?>

				</div>
			</td>
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

		<tr>
			<td colspan="3" class="blank-bottom"> </td>
			<td colspan="1" class="total-line"><textarea rows="5" cols="6"><?php echo $this->lang->line('sales_sub_total'); ?></textarea></td>
			<td class="total-value"><textarea rows="5" cols="6" id="subtotal"><?php echo to_currency($subtotal); ?></textarea></td>
		</tr>

<?php
if (empty($taxes)) { //if the taxes array is empty then show an empty "GST 10%    $0.00" line per request
    ?>


		<tr>
			<td colspan="3" class="blank"> </td>
			<td colspan="1" class="total-line"><textarea rows="5" cols="6">GST 10%</textarea></td>
			<td class="total-value"><textarea rows="5" cols="6" id="taxes"><?php echo to_currency_tax(0); ?></textarea></td>
		</tr>

<?php

} else {

    foreach ($taxes as $tax_group_index => $sales_tax) {
        ?>
				<tr>
					<td colspan="3" class="blank"> </td>
					<td colspan="1" class="total-line"><textarea rows="5" cols="6"><?php echo $sales_tax['tax_group']; ?></textarea></td>
					<td class="total-value"><textarea rows="5" cols="6" id="taxes"><?php echo to_currency_tax($sales_tax['sale_tax_amount']); ?></textarea></td>
				</tr>
<?php
}
}

?>

		<tr>
			<td colspan="3" class="blank"> </td>
			<td colspan="1" class="total-line"><textarea rows="5" cols="6"><?php echo $this->lang->line('sales_total'); ?></textarea></td>
			<td class="total-value"><textarea rows="5" cols="6" id="total"><?php echo to_currency($total); ?></textarea></td>
		</tr>

		<?php
$only_sale_check = false;
$show_giftcard_remainder = false;
foreach ($payments as $payment_id => $payment) {
    $only_sale_check |= $payment['payment_type'] == $this->lang->line('sales_check');
    $splitpayment = explode(':', $payment['payment_type']);
    $show_giftcard_remainder |= $splitpayment[0] == $this->lang->line('sales_giftcard');
    ?>
		<tr>
			<td colspan="3" class="blank"> </td>
			<td colspan="1" class="total-line"><textarea rows="5" cols="6"><?php echo $splitpayment[0]; ?></textarea></td>
			<td class="total-value"><textarea rows="5" cols="6" id="paid"><?php echo to_currency($payment['payment_amount'] * -1); ?></textarea></td>
		</tr>
		<?php
}

if (isset($cur_giftcard_value) && $show_giftcard_remainder) {
    ?>
		<tr>
			<td colspan="3" class="blank"> </td>
			<td colspan="1" class="total-line"><textarea rows="5" cols="6"><?php echo $this->lang->line('sales_giftcard_balance'); ?></textarea></td>
			<td class="total-value"><textarea rows="5" cols="6" id="giftcard"><?php echo to_currency($cur_giftcard_value); ?></textarea></td>
		</tr>
		<?php
}

if (!empty($payments)) {
    ?>
		<tr>
			<td colspan="3" class="blank"> </td>
			<td colspan="1" class="total-line"> <textarea rows="5" cols="6">Amount Due</textarea></td>
			<td class="total-value"><textarea rows="5" cols="6" id="change"><?php echo to_currency($amount_change); ?></textarea></td>
		</tr>
		<?php
}
?>

	</table>

	<div id="terms">
		<div id="sale_return_policy">
			<h5> <!-- To keep things clean and as we dont really use these fields, hiding if they are empty -->
				<?php if (!empty($this->config->item('payment_message'))) {?><textarea rows="5" cols="6"><?php echo nl2br($this->config->item('payment_message')); ?></textarea> <?php }?>
				<?php if (!empty($comments)) {?><textarea rows="5" cols="6"><?php echo empty($comments) ? '' : $this->lang->line('sales_comments') . ': ' . $comments; ?></textarea> <?php }?>
				<?php if (!empty($this->config->item('invoice_default_comments'))) {?><textarea rows="5" cols="6"><?php echo $this->config->item('invoice_default_comments'); ?></textarea> <?php }?>
			</h5>
			<?php echo nl2br($this->config->item('return_policy')); ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(window).on("load", function () {
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