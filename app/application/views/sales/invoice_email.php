<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'css/invoice_email.css';?>"/>
</head>

<body>
<?php
	if(isset($error_message))
	{
		echo "<div class='alert alert-dismissible alert-danger'>".$error_message."</div>";
		exit;
	}

	// Temporarily loads the system language for _lang to print invoice in the system language rather than user defined.
	load_language(TRUE, array('sales', 'common'));
?>

<div id="page-wrap">
	<table id="info">
		<tr>
			<td id="logo">
				<img class="cbv-invoice-logo" src="<?php echo base_url('images/cbv-logo-black.png'); ?>" alt="company_logo" />
				<div id="tax-invoice">TAX INVOICE</div>
			</td>
			<td id="customer-title">
				<pre class="customer-info"><?php if(isset($customer)) { echo $customer_info; } ?></pre>
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
					<td class="meta-head"><?php echo $this->lang->line('sales_invoice_number');?> </td>
					<td><div><?php echo $invoice_number; ?></div></td>
				</tr>
				<tr>
					<td class="meta-head"><?php echo $this->lang->line('common_date'); ?></td>
					<td><div><?php echo $transaction_date; ?></div></td>
				</tr>
					<tr>
						<td class="meta-head"><?php echo $this->lang->line('sales_amount_due'); ?></td>
						<td><div class="due"><?php echo to_currency($total); ?></div></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	<table id="items">
		<tr>
			<th><?php echo $this->lang->line('sales_item_name'); ?></th>
			<th><?php echo $this->lang->line('sales_quantity'); ?></th>
			<th><?php echo $this->lang->line('sales_price'); ?></th>
			<th><?php echo $this->lang->line('sales_discount'); ?></th>
			<?php if ($item['discount'] > 0): ?>
			<th><?php echo $this->lang->line('sales_customer_discount');?></th>
			<?php endif; ?>
			<th><?php echo $this->lang->line('sales_total'); ?></th>
		</tr>

		<?php
		foreach($cart as $line=>$item)
		{
		?>
			<tr class="item-row">
				<td class="item-name"><?php echo $item['name']; ?></td>
				<td><?php echo to_quantity_decimals($item['quantity']); ?></td>
				<td><?php echo to_currency($item['price']); ?></td>
				<td><?php echo $item['discount']; ?></td>
				<?php if ($item['discount'] > 0): ?>
				<td><?php echo to_currency($item['discounted_total'] / $item['quantity']); ?></td>
				<?php endif; ?>
				<td class="total-line"><?php echo to_currency($item['discounted_total']); ?></td>
			</tr>
			<tr class="item-row" <?php echo !($item['item_category'] == "Laptop" || $item['item_category'] == "Desktop") ? 'style="display:none"' : '' ?>>
			<td class="item-description" colspan="5">
			<div><b>Machine Specs:</b> <?php echo $item['description']; ?></div>
			</td>
		</tr>
		<?php
		}
		?>

		<tr>
			<td colspan="5" align="center" class="blank"><?php echo '&nbsp;'; ?></td>
		</tr>

		<tr>
			<td colspan="3" class="blank"> </td>
			<td colspan="1" class="total-line"><?php echo $this->lang->line('sales_sub_total'); ?></td>
			<td id="subtotal" class="total-value"><?php echo to_currency($subtotal); ?></td>
		</tr>

		<?php
		foreach($taxes as $tax_group_index=>$sales_tax)
		{
		?>
			<tr>
				<td colspan="3" class="blank"> </td>
				<td colspan="1" class="total-line"><?php echo $sales_tax['tax_group']; ?></td>
				<td id="taxes" class="total-value"><?php echo to_currency_tax($sales_tax['sale_tax_amount']); ?></td>
			</tr>
		<?php
		}
		?>

		<tr>
			<td colspan="3" class="blank"> </td>
			<td colspan="1" class="total-line"><?php echo $this->lang->line('sales_total'); ?></td>
			<td id="total" class="total-value"><?php echo to_currency($total); ?></td>
		</tr>
	</table>

	<div id="terms">
		<div id="sale_return_policy">

					<div class="inv-comments">

					<?php echo (empty($comments) ? $this->config->item('invoice_default_comments') : $comments); ?></div>

			<?php echo nl2br($this->config->item('return_policy')); ?>

	</div>
</div>

</body>
</html>
