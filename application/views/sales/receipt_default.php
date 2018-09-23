<?php
	// Temporarily loads the system language for to print receipt in the system language rather than user defined.
	load_language(TRUE,array('customers','sales','employees'));
?>

<div id="page-wrap">



	<div id="block1">
		<div id="customer-title">
			<?php
if (isset($customer)) {
    ?>
			<textarea id="customer" rows="5" cols="6"><?php echo $customer_info ?></textarea>
			<?php
}
?>
		</div>


		<?php
		if($this->config->item('company_logo') != '')
		{
		?>
		<div id="logo">
			<?php
if ($this->Appconfig->get('company_logo') === null) {
    ?>
			<img id="image" src="<?php echo base_url('uploads/' . $this->Appconfig->get('company_logo')); ?>" alt="company_logo" />
			<?php
} else {
    ?>
			<img id="image" class="cbv-invoice-logo" src="<?php echo base_url('images/cbv-logo-black.png'); ?>" alt="company_logo" />
			<?php
}
?>
			<div>&nbsp</div>
			<div id="tax-invoice">TAX INVOICE</div>
		</div>
	</div>
		<?php
		}
		?>


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
				<?php echo $this->lang->line('sales_id') ?>
				</td>
				<td><textarea rows="5" cols="6"><?php echo $sale_id; ?></textarea></td>
			</tr>
		<?php
		if(!empty($invoice_number))
		{
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
					<?php echo $this->lang->line('employees_employee') ?>
				</td>
				<td><textarea rows="5" cols="6"><?php echo $employee; ?></textarea></td>
			</tr>
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
		foreach($cart as $line=>$item)
		{
		?>

		<tr class="item-row">
			<td colspan="2" class="item-name"><textarea rows="4" cols="6"><?php echo ucfirst($item['name']); ?></textarea></td>
			<td style='text-align:center;'><textarea rows="5" cols="6"><?php echo to_currency($item['price']); ?></textarea></td>
			<td><textarea rows="4" cols="4"><?php echo to_quantity_decimals($item['quantity']); ?></textarea></td>
			<td class="total-value" style='border-right: solid 1px; text-align:right;'><textarea rows="4" cols="6"><?php echo to_currency($item[($this->config->item('receipt_show_total_discount') ? 'total' : 'discounted_total')]); ?></textarea></td>
		</tr>

		<?php
if ($this->config->item('receipt_show_description') && !empty($item['description'])) {
        ?>
		<tr class="item-row">
			<td class="item-description" colspan="5">
				<div>

					<?php

        if (!empty($item['description'])) {

            $descArr = explode(",", $item['description'], 2); // break up the description based on , delimiter
            $firstItem = $descArr[0]; // grab the first item in the array

            if ($firstItem == 'Laptop' || $firstItem == 'Desktop') { // if its Laptop or Desktop then
                echo '<b>Machine Specs:</b>  '; // Echo "Machine Specs" prior to the description
            }
            echo str_replace(", ,", ", ", $item['description']); //strip double comma ', ,' - a little bit cleaner for missing custom fields
        }
        ?>

				</div>
			</td>
		</tr>
		<?php
}
?>
			<?php
			if($item['discount'] > 0)
			{
			?>
				<tr>
				<td colspan="3" class="blank"> </td>
					<td colspan="1" class="blank"><?php echo number_format($item['discount'], 0) . " " . $this->lang->line("sales_discount_included")?></td>
					<td class="total-line"><?php echo to_currency($item['discounted_total']) ; ?></td>
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
		if($this->config->item('receipt_show_total_discount') && $discount > 0)	{
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
		if($this->config->item('receipt_show_taxes'))
		{
		?>
			<tr>
				<td colspan="3" class="blank"> </td>
				<td colspan="1" class="total-line" style='text-align:right;border-top:2px solid #000000;'><?php echo $this->lang->line('sales_sub_total'); ?></td>
				<td class="total-value" style='text-align:right;border-top:2px solid #000000;'><?php echo to_currency($subtotal); ?></td>
			</tr>
			<?php
			foreach($taxes as $tax_group_index=>$sales_tax)
			{
			?>
				<tr>
					<td colspan="3" class="blank"> </td>
					<td colspan="1" class="total-line"><?php echo $sales_tax['tax_group']; ?>:</td>
					<td class="total-value"><?php echo to_currency_tax($sales_tax['sale_tax_amount']); ?></td>
				</tr>
			<?php
			}
			?>
		<?php
		}
		?>

		<tr>
		</tr>

		<?php $border = (!$this->config->item('receipt_show_taxes') && !($this->config->item('receipt_show_total_discount') && $discount > 0)); ?>
		<tr>
			<td colspan="3" class="blank"> </td>
			<td colspan="1" class="total-line" style="text-align:right;<?php echo $border? 'border-top: 2px solid black;' :''; ?>"><?php echo $this->lang->line('sales_total'); ?></td>
			<td class="total-value" style="text-align:right;<?php echo $border? 'border-top: 2px solid black;' :''; ?>"><?php echo to_currency($total); ?></td>
		</tr>

		<tr>
			<td colspan="3" class="blank"> </td>
			<td colspan="2">&nbsp;</td>

		</tr>

		<?php
		$only_sale_check = FALSE;
		$show_giftcard_remainder = FALSE;
		foreach($payments as $payment_id=>$payment)
		{
			$only_sale_check |= $payment['payment_type'] == $this->lang->line('sales_check');
			$splitpayment = explode(':', $payment['payment_type']);
			$show_giftcard_remainder |= $splitpayment[0] == $this->lang->line('sales_giftcard');
		?>
			<tr>
				<td colspan="3" class="blank"> </td>
				<td colspan="1" style="text-align:right;" class="total-line"><?php echo $splitpayment[0]; ?> </td>
				<td class="total-value"><?php echo to_currency( $payment['payment_amount'] * -1 ); ?></td>
			</tr>
		<?php
		}
		?>

		<?php
		if(isset($cur_giftcard_value) && $show_giftcard_remainder)
		{
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
			<td colspan="1" style="text-align:right;" class="total-line"> <?php echo $this->lang->line($amount_change >= 0 ? ($only_sale_check ? 'sales_check_balance' : 'sales_change_due') : 'sales_amount_due') ; ?> </td>
			<td class="total-value"><?php echo to_currency($amount_change); ?></td>
		</tr>
	</table>

	<div id="sale_return_policy" style="">
		<?php echo nl2br($this->config->item('return_policy')); ?>
	</div>


<!-- routine for inserting extra info like passwords, for PC and Laptop sales -->
<br><br><br> <!-- TODO: Remove this ! -->
<?php

foreach ($cart as $line => $item) {

	if (in_array($item['item_category'], ['Laptop', 'Desktop', 'Tower', 'All-in-One'])) {

?>

		<div class="Thankyou-Note"><?php echo $this->lang->line('sales_receipt_extra_page_note'); ?></div>
		<div class="page2 noscreen" style="align-content:center">
			<iframe src="https://docs.google.com/document/d/e/2PACX-1vTP5AZ1BVBGMpsB2J1bulYhVUtHS70bMxXBBzN5BM2SuHKCVMjeWpLhAZ2w8sxJ5yWAqTUIBNwqYHGp/pub?embedded=true" height="1100px" width="950px" scrolling="no" style="border:none;"></iframe>
		</div>
<?php
		$hasMachines = True;
		break;
		}

	if(!hasMachines){
?>
		<div class="Thankyou-Note"><?php echo $this->lang->line('sales_receipt_thank_you'); ?></div>
<?php
	}
}
?>

</div>