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
			<img id="image" class="cbv-invoice-logo" src="<?php echo base_url('images/cbv-logo-black.png'); ?>" alt="company_logo" />
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
			<?php echo $this->lang->line('sales_description_abbrv'); ?>
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

    if ($item['item_category'] == "Laptop" || $item['item_category'] === "Desktop") { // if the item is a desktop or laptop

        $itemName = "CBV " . $item['name'] . " (" . $item['item_category'] . ")"; // change the name to "CBV XXXX (Type)"

    } else {
        $itemName = ucfirst($item['name']); // otherwise just use the name
    }

    ?>

		<tr class="item-row">
			<td colspan="2" class="item-name"><textarea rows="4" cols="6"><?php echo $itemName ?></textarea></td>
			<td style='text-align:center;'><textarea rows="5" cols="6"><?php echo to_currency($item['price']); ?></textarea></td>
			<td><textarea rows="4" cols="4"><?php echo to_quantity_decimals($item['quantity']); ?></textarea></td>
			<td class="" style=''><textarea rows="4" cols="6"><?php echo to_currency($item[($this->config->item('receipt_show_total_discount') ? 'total' : 'discounted_total')]); ?></textarea></td>
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
    ?>
			<?php
if ($item['discount'] > 0) {
        ?>
				<tr>
				<td colspan="3" class="blank"> </td>
					<td colspan="1" class="blank">$<?php echo number_format($item['discount'], 2) ?> Discount</td>
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
				<td colspan="1" class="total-line" style='text-align:right;border-top:2px solid #000000;'><?php echo $this->lang->line('sales_sub_total'); ?></td>
				<td class="total-value" style='text-align:right;border-top:2px solid #000000;'><?php echo to_currency($prediscount_subtotal); ?></td>
			</tr>
			<tr>
				<td colspan="3" class="blank"> </td>
				<td colspan="1" class="total-line"><?php echo $this->lang->line('sales_customer_discount'); ?>:</td>
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
				<td colspan="1" class="total-line" style='text-align:right;border-top:2px solid #000000;'><?php echo $this->lang->line('sales_sub_total'); ?></td>
				<td class="total-value" style='text-align:right;border-top:2px solid #000000;'><?php echo to_currency($subtotal); ?></td>
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
			<td colspan="1" class="total-line" style="text-align:right;<?php echo $border ? 'border-top: 2px solid black;' : ''; ?>"><?php echo $this->lang->line('sales_total'); ?></td>
			<td class="total-value" style="text-align:right;<?php echo $border ? 'border-top: 2px solid black;' : ''; ?>"><?php echo to_currency($total); ?></td>
		</tr>

		<tr>
			<td colspan="3" class="blank"> </td>
			<td colspan="2">&nbsp;</td>

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
				<td colspan="1" style="text-align:right;" class="total-line"><?php echo $splitpayment[0]; ?> </td>
				<td class="total-value"><?php echo to_currency($payment['payment_amount'] * -1); ?></td>
			</tr>
		<?php
}
?>

		<?php
if (isset($cur_giftcard_value) && $show_giftcard_remainder) {
    ?>
		<tr>
		<td colspan="3" class="blank"> </td>
			<td colspan="1" style="text-align:right;"><?php echo $this->lang->line('sales_giftcard_balance'); ?></td>
			<td class="total-value"><?php echo to_currency($cur_giftcard_value); ?></td>
		</tr>
		<?php
}
?>
		<tr>
		<td colspan="3" class="blank"> </td>
			<td colspan="1" style="text-align:right;" class="total-line"> Amount Due </td>
			<td class="total-value"><?php echo to_currency($amount_change); ?></td>
		</tr>
	</table>

	<div id="sale_return_policy" style="">
		<?php echo nl2br($this->config->item('return_policy')); ?>
	</div>


<!-- routine for inserting extra info like passwords, for PC and Laptop sales -->
<!-- TODO: Remove this ! -->
<?php

foreach ($cart as $line => $item) {

    if (in_array($item['item_category'], ['Laptop', 'Desktop', 'Tower', 'All-in-One'])) {

        ?>



		<div class="Thankyou-Note"><?php echo $this->lang->line('sales_receipt_extra_page_note'); ?></div>

		<div class="pagebreak"></div>

			<?php include 'user-info.php'; // in ~/public/ ?>
<?php
$hasMachines = true;
        break;
    }

    if (!hasMachines) {
        ?>
		<div class="Thankyou-Note"><?php echo $this->lang->line('sales_receipt_thank_you'); ?></div>
<?php
}
}
?>

</div>