<?php $this->load->view("partial/header");?>

<?php
if (isset($error)) {
    echo "<div class='alert alert-dismissible alert-danger'>" . $error . "</div>";
}

if (!empty($warning)) {
    echo "<div class='alert alert-dismissible alert-warning'>" . $warning . "</div>";
}

if (isset($success)) {
    echo "<div class='alert alert-dismissible alert-success'>" . $success . "</div>";
}

$saleMode = $mode;

if ($saleMode == "return") {
    $cusReq = "(Required for Refund)";
} else {
    $cusReq = $customer_required;
}

?>

<!-- Modal -->
<div class="modal bootstrap-dialog modal-dlg type-primary fade size-normal in" id="salesHelp" tabindex="-1" role="dialog" aria-labelledby="salesHelpModal" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:800px">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="bootstrap-dialog-title" id="salesHelpModal">Sales Register Help</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="alert alert-info">
  <strong>New Equipment:</strong> This is only applicable for items which Computerbank have purchased and not new donated equipment.
  <br><br>
  <b>Example:</b> If a customer donates a <i>new</i> HDMI cable then this should be sold as 'Used Equipment'. Individual items are already created
for new equipment, for example 'USB Wifi Stick'
</div>
<br>
<h4>Which item do I choose on the register?</h4>
<br>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">I am selling..</th>
              <th scope="col">POS Item to Select</th>
              <th scope="col">Description to Use</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Desktop or Laptop</th>
              <td>Individual Computer <br>(eg <i>9510</i>)</td>
			  <td>Description is automatic and contains the computer specs</td>
						</tr>
            <tr>
			<th scope="row">Computer Deposits</th>
              <td>Deposit (Laptop/Desktop)</td>
							<td>Enter computer ID in to the template provided: <br><span class="label label-darkblue">Deposit for Laptop XXXX</span></td>
						</tr>
            <tr>
			<th scope="row">New Equipment</th>
              <td>See Above Notice</td>
			  <td>Description is automatic and is preset for the specific item</td>
						</tr>
            <tr>
			<th scope="row">Used Equipment</th>
              <td>Shop Sales</td>
			  <td>Enter a short item description in space provided:<br><span class="label label-darkblue">Wireless Keyboard</span> or <span class="label label-darkblue">HDMI Cable</span></td>
            </tr>
            <tr>
			<th scope="row">Ebay Sales</th>
              <td>Ebay Sales</td>
			  <td>Enter the item name and number in the template provided: <br><span class="label label-darkblue">Ebay Sale for Macbook Pro 1234567890000</span></td>
						</tr>
            <tr>
			<th scope="row">User Support</th>
              <td>User Support</td>
			  <td>Enter computer ID in to the template provided: <br><span class="label label-darkblue">User Support for Computer XXXX</span></td>
						</tr>
          </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div id="register_wrapper">

<!-- Top register controls -->

	<?php echo form_open($controller_name . "/change_mode", array('id' => 'mode_form', 'class' => 'form-horizontal panel panel-default' . (!($saleMode == 'sale') ? ' non-sale' : ''))); ?>
		<div class="panel-body form-group<?php echo(!($saleMode == 'sale') ? ' non-sale' : '') ?>">
			<ul>
				<li class="pull-left first_li">
					<label class="control-label"><?php echo $this->lang->line('sales_mode'); ?></label>
				</li>
				<li class="pull-left">
					<?php echo form_dropdown('mode', $modes, $mode, array('onchange' => "$('#mode_form').submit();", 'class' => 'selectpicker show-menu-arrow', 'data-style' => ($saleMode == 'sale' ? 'btn-default btn-sm' : 'btn-default btn-sm non-sale'), 'data-width' => 'fit')); ?>
				</li>
				<?php
if ($this->config->item('dinner_table_enable') == true) {
    ?>
					<li class="pull-left first_li">
						<label class="control-label"><?php echo $this->lang->line('sales_table'); ?></label>
					</li>
					<li class="pull-left">
						<?php echo form_dropdown('dinner_table', $empty_tables, $selected_table, array('onchange' => "$('#mode_form').submit();", 'class' => 'selectpicker show-menu-arrow', 'data-style' => 'btn-default btn-sm', 'data-width' => 'fit')); ?>
					</li>
				<?php
}
if (count($stock_locations) > 1) {
    ?>
					<li class="pull-left">
						<label class="control-label"><?php echo $this->lang->line('sales_stock_location'); ?></label>
					</li>
					<li class="pull-left">
						<?php echo form_dropdown('stock_location', $stock_locations, $stock_location, array('onchange' => "$('#mode_form').submit();", 'class' => 'selectpicker show-menu-arrow', 'data-style' => 'btn-default btn-sm', 'data-width' => 'fit')); ?>
					</li>
				<?php
}
?>

				<li class="pull-right">
					<button class='btn btn-default btn-sm modal-dlg <?php echo(!($saleMode == "sale") ? "non-sale" : ""); ?>' id='show_suspended_sales_button' data-href='<?php echo site_url($controller_name . "/suspended"); ?>'
							title='<?php echo $this->lang->line('sales_suspended_sales'); ?>'>
						<span class="glyphicon glyphicon-align-justify">&nbsp</span><?php echo $this->lang->line('sales_suspended_sales'); ?>
					</button>
				</li>

				<?php
if ($this->Employee->has_grant('reports_sales', $this->session->userdata('person_id'))) {
    ?>
					<li class="pull-right">
						<?php echo anchor(
        $controller_name . "/manage",
        '<span class="glyphicon glyphicon-list-alt">&nbsp</span>' . $this->lang->line('sales_takings'),
        array('class' => 'btn btn-primary btn-sm' . (!($saleMode == 'sale') ? ' non-sale' : ''), 'id' => 'sales_takings_button', 'title' => $this->lang->line('sales_takings'))
    ); ?>
					</li>
				<?php
}
?>
			</ul>
		</div>
	<?php echo form_close(); ?>

	<?php $tabindex = 0;?>

	<?php echo form_open($controller_name . "/add", array('id' => 'add_item_form', 'class' => 'form-horizontal panel panel-default' . (!($saleMode == 'sale') ? ' non-sale' : ''))); ?>
		<div class="panel-body form-group">
			<ul>
				<li class="pull-left first_li">
					<label for="item" class='control-label'><?php echo $this->lang->line('sales_find_or_scan_item_or_receipt'); ?></label>
				</li>
				<li class="pull-left">
					<?php echo form_input(array('name' => 'item', 'id' => 'item', 'class' => 'form-control input-sm', 'size' => '50', 'tabindex' => ++$tabindex)); ?>
					<span class="ui-helper-hidden-accessible" role="status"></span>
				</li>
				<li class="pull-right">
				<button data-toggle="modal" data-target="#salesHelp" type="button" class="btn btn-info btn-sm pull-right <?php echo(!($saleMode == "sale") ? "non-sale" : ""); ?>">
				<span class="glyphicon glyphicon-question-sign">&nbsp</span>Item Help
				</button>
				</li>
			</ul>
		</div>
	<?php echo form_close(); ?>

<!-- Sale Items List -->

	<table class="sales_table_100<?php echo(!($saleMode == 'sale') ? ' non-sale' : '') ?>" id="register">
		<thead>
			<tr>
				<th style="width: 5%;"><?php echo $this->lang->line('common_delete'); ?></th>
				<th colspan="2" style="width: 35%;"><?php echo $this->lang->line('sales_item_name'); ?></th>
				<th style="width: 10%;"><?php echo $this->lang->line('sales_price'); ?></th>
				<th style="width: 10%;"><?php echo $this->lang->line('sales_quantity'); ?></th>
				<th style="width: 10%;"><?php echo $this->lang->line('sales_discount'); ?></th>
				<th style="width: 10%;"><?php echo $this->lang->line('sales_total'); ?></th>
				<th style="width: 5%;"><?php echo $this->lang->line('sales_update'); ?></th>
			</tr>
		</thead>

		<tbody id="cart_contents">
			<?php
if (count($cart) == 0) {
    ?>
				<tr>
					<td colspan='8'>
						<div class='alert alert-dismissible alert-<?php echo(!($saleMode == 'sale') ? 'warning' : 'info') ?>'><?php echo $this->lang->line('sales_no_items_in_cart'); ?></div>
					</td>
				</tr>
			<?php
} else {
        foreach (array_reverse($cart, true) as $line => $item) {
            if ($item['name'] == "Shop Sales") {
                $hasShopSale = true;
            } ?>

<?php
if ((substr($item['name'], 0, 7) == 'Deposit') || ($item['item_category'] == ('User Support' || 'Ebay Sales' || 'Cost of Sharing Services' || 'Donation'))) { // if the item is a desktop or laptop category
                $item['name'] = $item['name'];
            } else {
                $item['name'] = $item['name'] . " (" . $item['item_category'] . ")";
            } ?>

					<?php echo form_open($controller_name . "/edit_item/$line", array('class' => 'form-horizontal', 'id' => 'cart_' . $line)); ?>
						<tr>
							<td><?php echo anchor($controller_name . "/delete_item/$line", '<span class="glyphicon glyphicon-trash"></span>'); ?></td>
							<td colspan="2" style="align: center;">
								<?php echo $item['name']; ?>
								<br /> <?php if ($item['stock_type'] == '0' && ($item['item_category'] != ('Laptop' || 'Desktop'))): echo '[' . to_quantity_decimals($item['in_stock']) . ' in ' . $item['stock_name'] . ']';
            endif; ?>
								<?php echo form_hidden('location', $item['item_location']); ?>
							</td>

							<?php
if ($items_module_allowed) {
                ?>
								<td><?php echo form_input(array('name' => 'price', 'class' => 'form-control input-sm center', 'value' => to_currency_no_money($item['price']), 'tabindex' => ++$tabindex, 'onClick' => 'this.select();')); ?></td>
							<?php
            } else {
                ?>
								<td>
									<?php echo to_currency($item['price']); ?>
									<?php echo form_hidden('price', to_currency_no_money($item['price'])); ?>
								</td>
							<?php
            } ?>

							<td>
								<?php
if ($item['is_serialized'] == 1) {
                echo to_quantity_decimals($item['quantity']);
                echo form_hidden('quantity', $item['quantity']);
            } else {
                echo form_input(array('name' => 'quantity', 'class' => 'form-control input-sm center', 'value' => to_quantity_decimals($item['quantity']), 'tabindex' => ++$tabindex, 'onClick' => 'this.select();'));
            } ?>
							</td>

							<td><?php echo form_input(array('name' => 'discount', 'class' => 'form-control input-sm center', 'value' => to_decimals($item['discount'], 0), 'tabindex' => ++$tabindex, 'onClick' => 'this.select();')); ?></td>
							<td>
								<?php
if ($item['item_type'] == ITEM_AMOUNT_ENTRY) {
                echo form_input(array('name' => 'discounted_total', 'class' => 'form-control input-sm', 'value' => to_currency_no_money($item['discounted_total']), 'tabindex' => ++$tabindex, 'onClick' => 'this.select();'));
            } else {
                echo to_currency($item['discounted_total']);
            } ?>
							</td>
							<td><a href="javascript:document.getElementById('<?php echo 'cart_' . $line ?>').submit();" title=<?php echo $this->lang->line('sales_update') ?> ><span class="glyphicon glyphicon-refresh"></span></a></td>
							</tr>
							<tr>
							<?php
if ($item['allow_alt_description'] == 1) {
                ?>
								<td class="sale-list <?php echo(!($saleMode == "sale") ? "non-sale" : ""); ?>" style="color: #2F4F4F;"><?php echo $this->lang->line('sales_description_abbrv'); ?></td>
							<?php
            } ?>

							<td colspan='8' style="text-align: left;padding-left:10px;" class="sale-list<?php echo(!($saleMode == 'sale') ? ' non-sale' : '') ?>">
								<?php
if ($item['allow_alt_description'] == 1) {
                echo form_input(array('name' => 'description', 'class' => 'form-control input-sm', 'value' => $item['description'], 'placeholder' => $this->lang->line('sales_description_abbrv_helper')));
            } else {
                if ($item['description'] != '') {
                    echo '<b>Description: </b>';
                    echo $item['description'];
                    echo form_hidden('description', $item['description']);
                } else {
                    echo $this->lang->line('sales_no_description');
                    echo form_hidden('description', '');
                }
            } ?>
							</td>
						</tr>
					<?php echo form_close(); ?>
			<?php
        }
    }
?>
		</tbody>
	</table>

	<?php echo form_close();

    if ($hasShopSale == 1) {
        ?>
	<div class="alert alert-danger" role="alert" style="margin-top:10px;">
		<b>Important Reminder</b><br>
		The <i>Shop Sales</i> item should only be selected for used or donated equipment, new items such as a USB Wifi
		Stick <b>MUST</b> be loaded under their respective items to ensure correct tax amount is reported.
	</div>

<?php
    }
?>

</div>

<!-- Overall Sale -->

<div id="overall_sale" class="panel panel-default<?php echo(!($saleMode == 'sale') ? ' non-sale' : '') ?>">
	<div class="panel-body">
		<?php echo form_open($controller_name . "/select_customer", array('id' => 'select_customer_form', 'class' => 'form-horizontal' . (!($saleMode == 'sale') ? ' non-sale' : ''))); ?>
			<?php
if (isset($customer)) {
    ?>
				<table class="sales_table_100">
					<tr>
						<th style='width: 55%;'><?php echo $this->lang->line("sales_customer"); ?></th>
						<th style="width: 45%; text-align: right;"><?php echo anchor('customers/view/' . $customer_id, $customer, array('class' => 'modal-dlg', 'data-btn-submit' => $this->lang->line('common_submit'), 'title' => $this->lang->line('customers_update'))); ?></th>
					</tr>
					<?php
if (!empty($customer_email)) {
        ?>
						<tr>
							<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_email"); ?></th>
							<th style="width: 45%; text-align: right;"><?php echo $customer_email; ?></th>
						</tr>
					<?php
    } ?>
					<?php
if (!empty($customer_address)) {
        ?>
						<tr>
							<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_address"); ?></th>
							<th style="width: 45%; text-align: right;"><?php echo $customer_address; ?></th>
						</tr>
					<?php
    } ?>
					<?php
if (!empty($customer_location)) {
        ?>
						<tr>
							<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_location"); ?></th>
							<th style="width: 45%; text-align: right;"><?php echo $customer_location; ?></th>
						</tr>
					<?php
    } ?>
					<?php if ($this->config->item('customer_reward_enable') == true): ?>
					<?php
if (!empty($customer_rewards)) {
        ?>
						<tr>
							<th style='width: 55%;'><?php echo $this->lang->line("rewards_package"); ?></th>
							<th style="width: 45%; text-align: right;"><?php echo $customer_rewards['package_name']; ?></th>
						</tr>
						<tr>
							<th style='width: 55%;'><?php echo $this->lang->line("customers_available_points"); ?></th>
							<th style="width: 45%; text-align: right;"><?php echo $customer_rewards['points']; ?></th>
						</tr>
					<?php
    } ?>
					<?php endif; ?>
					<tr>
						<th style='width: 55%;'><?php echo $this->lang->line("sales_customer_total"); ?></th>
						<th style="width: 45%; text-align: right;"><?php echo to_currency($customer_total); ?></th>
					</tr>

					<?php
if (!empty($customer_comments)) {
        ?>
						<tr>
							<th style='width: 100%;' colspan="2">
							<div class="alert alert-danger customer-comments" role="alert">
								<b>Customer Comments:</b><br>
								<?php echo $customer_comments; ?>
							</div>
						</th>
						</tr>
					<?php
    } ?>

				</table>

				<?php echo anchor(
            $controller_name . "/remove_customer",
            '<span class="glyphicon glyphicon-remove">&nbsp</span>' . $this->lang->line('common_remove') . ' ' . $this->lang->line('customers_customer'),
            array('class' => 'btn btn-danger btn-sm', 'id' => 'remove_customer_button', 'title' => $this->lang->line('common_remove') . ' ' . $this->lang->line('customers_customer'))
    ); ?>
			<?php
} else {
        ?>
				<div class="form-group" id="select_customer">
					<label id="customer_label" for="customer" class="control-label<?php echo(!($saleMode == 'sale') ? ' non-sale' : '') ?>	" style="margin-bottom: 1em; margin-top: -1em;"><?php echo $this->lang->line('sales_select_customer') . ' ' . $cusReq; ?></label>
					<?php echo form_input(array('name' => 'customer', 'id' => 'customer', 'class' => 'form-control input-sm', 'value' => $this->lang->line('sales_start_typing_customer_name'))); ?>

					<button class='btn btn-info btn-sm modal-dlg<?php echo(!($saleMode == 'sale') ? ' non-sale' : '') ?>' data-btn-submit='<?php echo $this->lang->line('common_submit') ?>' data-href='<?php echo site_url("customers/view"); ?>'
							title='<?php echo $this->lang->line($controller_name . '_new_customer'); ?>'>
						<span class="glyphicon glyphicon-user">&nbsp</span><?php echo $this->lang->line($controller_name . '_new_customer'); ?>
					</button>

				</div>
			<?php
    }
?>
		<?php echo form_close(); ?>

		<table class="sales_table_100<?php echo(!($saleMode == 'sale') ? ' non-sale' : '') ?>" id="sale_totals">
			<tr>
				<th style="width: 55%;"><?php echo $this->lang->line('sales_quantity_of_items', $item_count); ?></th>
				<th style="width: 45%; text-align: right;"><?php echo $total_units; ?></th>
			</tr>
			<tr>
				<th style="width: 55%;"><?php echo $this->lang->line('sales_sub_total'); ?></th>
				<th style="width: 45%; text-align: right;"><?php echo to_currency($subtotal); ?></th>
			</tr>

			<?php
foreach ($taxes as $tax_group_index => $sales_tax) {
    ?>
				<tr>
					<th style='width: 55%;'><?php echo $sales_tax['tax_group']; ?></th>
					<th style="width: 45%; text-align: right;"><?php echo to_currency_tax($sales_tax['sale_tax_amount']); ?></th>
				</tr>
			<?php
}
?>

			<tr>
				<th style='width: 55%;'><?php echo $this->lang->line('sales_total'); ?></th>
				<th style="width: 45%; text-align: right;"><span id="sale_total"><?php echo to_currency($total); ?></span></th>
			</tr>
		</table>

		<?php
// Only show this part if there are Items already in the sale.
if (count($cart) > 0) {
    ?>
			<table class="sales_table_100<?php echo(!($saleMode == 'sale') ? ' non-sale' : '') ?>" id="payment_totals">
				<tr>
					<th style="width: 55%;"><?php echo $this->lang->line('sales_payments_total'); ?></th>
					<th style="width: 45%; text-align: right;"><?php echo to_currency($payments_total); ?></th>
				</tr>
				<tr>
					<th style="width: 55%;"><?php echo $this->lang->line('sales_amount_due'); ?></th>
					<th style="width: 45%; text-align: right;"><span id="sale_amount_due"><?php echo to_currency($amount_due); ?></span></th>
				</tr>
			</table>

			<div id="payment_details" class="<?php echo(!($saleMode == 'sale') ? 'non-sale' : '') ?>">
				<?php
// Show Complete sale button instead of Add Payment if there is no amount due left
    if ($payments_cover_total) {
        ?>
					<?php echo form_open($controller_name . "/add_payment", array('id' => 'add_payment_form', 'class' => 'form-horizontal')); ?>
						<table class="sales_table_100">
							<tr>
								<td><?php echo $this->lang->line('sales_payment'); ?></td>
								<td>
									<?php echo form_dropdown('payment_type', $payment_options, $selected_payment_type, array('id' => 'payment_types', 'class' => 'selectpicker show-menu-arrow', 'data-style' => ($saleMode == 'sale' ? 'btn-default btn-sm' : 'btn-default btn-sm non-sale'), 'data-width' => 'auto', 'disabled' => 'disabled')); ?>
								</td>
							</tr>
							<tr>
								<td><span id="amount_tendered_label"><?php echo $this->lang->line('sales_amount_tendered'); ?></span></td>
								<td>
									<?php echo form_input(array('name' => 'amount_tendered', 'id' => 'amount_tendered', 'class' => 'form-control input-sm disabled', 'disabled' => 'disabled', 'value' => '0', 'size' => '5', 'tabindex' => ++$tabindex, 'onClick' => 'this.select();')); ?>
								</td>
							</tr>
						</table>
					<?php echo form_close(); ?>
						<?php
// Only show this part if the payment cover the total and in sale or return mode
        if ($pos_mode == '1') {
            ?>
						<div class='btn btn-sm btn-success pull-right' id='finish_sale_button' tabindex='<?php echo ++$tabindex; ?>'><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $this->lang->line('sales_complete_sale'); ?></div>
						<?php
        } ?>
				<?php
    } else {
        ?>
					<?php echo form_open($controller_name . "/add_payment", array('id' => 'add_payment_form', 'class' => 'form-horizontal')); ?>
						<table class="sales_table_100">
							<tr>
								<td><?php echo $this->lang->line('sales_payment'); ?></td>
								<td>
									<?php echo form_dropdown('payment_type', $payment_options, $selected_payment_type, array('id' => 'payment_types', 'class' => 'selectpicker show-menu-arrow', 'data-style' => ($saleMode == 'sale' ? 'btn-default btn-sm' : 'btn-default btn-sm non-sale'), 'data-width' => 'fit')); ?>
								</td>
							</tr>
							<tr>
								<td><span id="amount_tendered_label"><?php echo $this->lang->line('sales_amount_tendered'); ?></span></td>
								<td>
									<?php echo form_input(array('name' => 'amount_tendered', 'id' => 'amount_tendered', 'class' => 'form-control input-sm non-giftcard-input', 'value' => to_currency_no_money($amount_due), 'size' => '5', 'tabindex' => ++$tabindex, 'onClick' => 'this.select();')); ?>
									<?php echo form_input(array('name' => 'amount_tendered', 'id' => 'amount_tendered', 'class' => 'form-control input-sm giftcard-input', 'disabled' => true, 'value' => to_currency_no_money($amount_due), 'size' => '5', 'tabindex' => ++$tabindex)); ?>
								</td>
							</tr>
						</table>
					<?php echo form_close(); ?>

					<div class='btn btn-sm btn-success pull-right' id='add_payment_button' tabindex='<?php echo ++$tabindex; ?>'><span class="glyphicon glyphicon-credit-card">&nbsp</span><?php echo $this->lang->line('sales_add_payment'); ?></div>
				<?php
    } ?>

				<?php
// Only show this part if there is at least one payment entered.
    if (count($payments) > 0) {
        ?>
					<table class="sales_table_100" id="register">
						<thead>
							<tr>
								<th style="width: 10%;"><?php echo $this->lang->line('common_delete'); ?></th>
								<th style="width: 60%;"><?php echo $this->lang->line('sales_payment_type'); ?></th>
								<th style="width: 20%;"><?php echo $this->lang->line('sales_payment_amount'); ?></th>
							</tr>
						</thead>

						<tbody id="payment_contents">
							<?php
foreach ($payments as $payment_id => $payment) {
            ?>
								<tr>
									<td><?php echo anchor($controller_name . "/delete_payment/$payment_id", '<span class="glyphicon glyphicon-trash"></span>'); ?></td>
									<td><?php echo $payment['payment_type']; ?></td>
									<td style="text-align: right;"><?php echo to_currency($payment['payment_amount']); ?></td>
								</tr>
							<?php
        } ?>
						</tbody>
					</table>
				<?php
    } ?>
			</div>

			<?php echo form_open($controller_name . "/cancel", array('id' => 'buttons_form')); ?>
				<div class="form-group" id="buttons_sale">
					<div class='btn btn-sm btn-default pull-left <?php echo(!($saleMode == "sale") ? "non-sale" : ""); ?>' id='suspend_sale_button'><span class="glyphicon glyphicon-align-justify">&nbsp</span><?php echo $this->lang->line('sales_suspend_sale'); ?></div>
					<?php
// Only show this part if the payment covers the total
    if (!$pos_mode && isset($customer) && $payments_cover_total) {
		?>
						<div class='btn btn-sm btn-success' id='finish_invoice_quote_button'><span class="glyphicon glyphicon-ok">&nbsp</span><?php echo $mode_label; ?></div>
					<?php
    } ?>

					<div class='btn btn-sm btn-danger pull-right' id='cancel_sale_button'><span class="glyphicon glyphicon-remove">&nbsp</span><?php echo $this->lang->line('sales_cancel_sale'); ?></div>
				</div>
			<?php echo form_close(); ?>

			<?php
// Only show this part if the payment cover the total
    if ($payments_cover_total || !$pos_mode) {
        ?>
				<div class="container-fluid">
					<div class="no-gutter row">
						<div class="form-group form-group-sm">
							<div class="col-xs-12">
								<?php echo form_label($this->lang->line('common_comments'), 'comments', array('class' => 'control-label', 'id' => 'comment_label', 'for' => 'comment')); ?>
								<?php echo form_textarea(array('name' => 'comment', 'id' => 'comment', 'class' => 'form-control input-sm', 'value' => $comment, 'rows' => '2')); ?>
							</div>
						</div>
					</div>
					<div class="row">

						<div class="form-group form-group-sm">
							<div class="col-xs-6">
								<label for="sales_print_after_sale" class="control-label checkbox">
									<?php echo form_checkbox(array('name' => 'sales_print_after_sale', 'id' => 'sales_print_after_sale', 'value' => 1, 'checked' => $print_after_sale)); ?>
									<?php echo $this->lang->line('sales_print_after_sale') ?>
								</label>
							</div>

							<?php
if (!empty($customer_email)) {
            ?>
								<div class="col-xs-6">
									<label for="email_receipt" class="control-label checkbox">
										<?php echo form_checkbox(array('name' => 'email_receipt', 'id' => 'email_receipt', 'value' => 1, 'checked' => $email_receipt)); ?>
										<?php echo $this->lang->line('sales_email_receipt'); ?>
									</label>
								</div>
							<?php
        } ?>
							<?php
if ($mode == "sale_work_order") {
            ?>
								<div class="col-xs-6">
									<label for="price_work_orders" class="control-label checkbox">
									<?php echo form_checkbox(array('name' => 'price_work_orders', 'id' => 'price_work_orders', 'value' => 1, 'checked' => $price_work_orders)); ?>
									<?php echo $this->lang->line('sales_include_prices'); ?>
									</label>
								</div>
							<?php
        } ?>
						</div>
					</div>
				<?php
if (($mode == 'sale') && $this->config->item('invoice_enable') == true) {
            ?>
					<div class="row">
						<div class="form-group form-group-sm">
							<div class="col-xs-6">
								<label for="sales_invoice_enable" class="control-label checkbox">
									<?php echo form_checkbox(array('name' => 'sales_invoice_enable', 'id' => 'sales_invoice_enable', 'value' => 1, 'checked' => $invoice_number_enabled)); ?>
									<?php echo $this->lang->line('sales_invoice_enable'); ?>
								</label>
							</div>

							<div class="col-xs-6">
								<div class="input-group input-group-sm">
									<span class="input-group-addon input-sm">#</span>
									<?php echo form_input(array('name' => 'sales_invoice_number', 'id' => 'sales_invoice_number', 'class' => 'form-control input-sm', 'value' => $invoice_number)); ?>
								</div>
							</div>
						</div>
					</div>
				<?php
        } ?>
				</div>
			<?php
    } ?>
		<?php
}
?>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function()
{
	$("#item").autocomplete(
	{
		source: '<?php echo site_url($controller_name . "/item_search"); ?>',
		minChars: 0,
		autoFocus: false,
		delay: 500,
		select: function (a, ui) {
			$(this).val(ui.item.value);
			$("#add_item_form").submit();
			return false;
		}
	});

	$('#item').focus();

	$('#item').keypress(function (e) {
		if(e.which == 13) {
			$('#add_item_form').submit();
			return false;
		}
	});

	$('#item').blur(function()
	{
		$(this).val("<?php echo $this->lang->line('sales_start_typing_item_name'); ?>");
	});

	var clear_fields = function()
	{
		if($(this).val().match("<?php echo $this->lang->line('sales_start_typing_item_name') . '|' . $this->lang->line('sales_start_typing_customer_name'); ?>"))
		{
			$(this).val('');
		}
	};

	$("#customer").autocomplete(
	{
		source: '<?php echo site_url("customers/suggest"); ?>',
		minChars: 0,
		delay: 10,
		select: function (a, ui) {
			$(this).val(ui.item.value);
			$("#select_customer_form").submit();
		}
	});

	$('#item, #customer').click(clear_fields).dblclick(function(event)
	{
		$(this).autocomplete("search");
	});

	$('#customer').blur(function()
	{
		$(this).val("<?php echo $this->lang->line('sales_start_typing_customer_name'); ?>");
	});

	$(".giftcard-input").autocomplete(
	{
		source: '<?php echo site_url("giftcards/suggest"); ?>',
		minChars: 0,
		delay: 10,
		select: function (a, ui) {
			$(this).val(ui.item.value);
			$("#add_payment_form").submit();
		}
	});

	$('#comment').keyup(function()
	{
		$.post('<?php echo site_url($controller_name . "/set_comment"); ?>', {comment: $('#comment').val()});
	});

	<?php
if ($this->config->item('invoice_enable') == true) {
    ?>
		$('#sales_invoice_number').keyup(function()
		{
			$.post('<?php echo site_url($controller_name . "/set_invoice_number"); ?>', {sales_invoice_number: $('#sales_invoice_number').val()});
		});

		var enable_invoice_number = function()
		{
			var enabled = $("#sales_invoice_enable").is(":checked");
			$("#sales_invoice_number").prop("disabled", !enabled).parents('tr').show();
			return enabled;
		}

		enable_invoice_number();

		$("#sales_invoice_enable").change(function()
		{
			var enabled = enable_invoice_number();
			$.post('<?php echo site_url($controller_name . "/set_invoice_number_enabled"); ?>', {sales_invoice_number_enabled: enabled});
		});
	<?php
}
?>

	$("#sales_print_after_sale").change(function()
	{
		$.post('<?php echo site_url($controller_name . "/set_print_after_sale"); ?>', {sales_print_after_sale: $(this).is(":checked")});
	});

	$("#price_work_orders").change(function()
	{
		$.post('<?php echo site_url($controller_name . "/set_price_work_orders"); ?>', {price_work_orders: $(this).is(":checked")});
	});

	$('#email_receipt').change(function()
	{
		$.post('<?php echo site_url($controller_name . "/set_email_receipt"); ?>', {email_receipt: $(this).is(":checked")});
	});

	$("#finish_sale_button").click(function()
	{
		$('#buttons_form').attr('action', '<?php echo site_url($controller_name . "/complete"); ?>');
		$('#buttons_form').submit();
	});

	$("#finish_invoice_quote_button").click(function()
	{
		$('#buttons_form').attr('action', '<?php echo site_url($controller_name . "/complete"); ?>');
		$('#buttons_form').submit();
	});

	$("#suspend_sale_button").click(function()
	{
		$('#buttons_form').attr('action', '<?php echo site_url($controller_name . "/suspend"); ?>');
		$('#buttons_form').submit();
	});

	$("#cancel_sale_button").click(function()
	{
		if(confirm('<?php echo $this->lang->line("sales_confirm_cancel_sale"); ?>'))
		{
			$('#buttons_form').attr('action', '<?php echo site_url($controller_name . "/cancel"); ?>');
			$('#buttons_form').submit();
		}
	});

	$("#add_payment_button").click(function()
	{
		$('#add_payment_form').submit();
	});

	$("#payment_types").change(check_payment_type).ready(check_payment_type);

	$("#cart_contents input").keypress(function(event)
	{
		if(event.which == 13)
		{
			$(this).parents("tr").prevAll("form:first").submit();
		}
	});

	$("#amount_tendered").keypress(function(event)
	{
		if(event.which == 13)
		{
			$('#add_payment_form').submit();
		}
	});

	$("#finish_sale_button").keypress(function(event)
	{
		if(event.which == 13)
		{
			$('#finish_sale_form').submit();
		}
	});

	dialog_support.init("a.modal-dlg, button.modal-dlg");

	table_support.handle_submit = function(resource, response, stay_open)
	{
		$.notify(response.message, { type: response.success ? 'success' : 'danger'} );

		if(response.success)
		{
			if(resource.match(/customers$/))
			{
				$("#customer").val(response.id);
				$("#select_customer_form").submit();
			}
			else
			{
				var $stock_location = $("select[name='stock_location']").val();
				$("#item_location").val($stock_location);
				$("#item").val(response.id);
				if(stay_open)
				{
					$("#add_item_form").ajaxSubmit();
				}
				else
				{
					$("#add_item_form").submit();
				}
			}
		}
	}

	$('[name="price"],[name="quantity"],[name="discount"],[name="description"],[name="serialnumber"],[name="discounted_total"]').change(function() {
		$(this).parents("tr").prevAll("form:first").submit()
	});
});

function check_payment_type()
{
	var cash_rounding = <?php echo json_encode($cash_rounding); ?>;

	if($("#payment_types").val() == "<?php echo $this->lang->line('sales_giftcard'); ?>")
	{
		$("#sale_total").html("<?php echo to_currency($total); ?>");
		$("#sale_amount_due").html("<?php echo to_currency($amount_due); ?>");
		$("#amount_tendered_label").html("<?php echo $this->lang->line('sales_giftcard_number'); ?>");
		$("#amount_tendered:enabled").val('').focus();
		$(".giftcard-input").attr('disabled', false);
		$(".non-giftcard-input").attr('disabled', true);
		$(".giftcard-input:enabled").val('').focus();
	}
	else if($("#payment_types").val() == "<?php echo $this->lang->line('sales_cash'); ?>" && cash_rounding)
	{
		$("#sale_total").html("<?php echo to_currency($cash_total); ?>");
		$("#sale_amount_due").html("<?php echo to_currency($cash_amount_due); ?>");
		$("#amount_tendered_label").html("<?php echo $this->lang->line('sales_amount_tendered'); ?>");
		$("#amount_tendered:enabled").val('<?php echo to_currency_no_money($cash_amount_due); ?>');
		$(".giftcard-input").attr('disabled', true);
		$(".non-giftcard-input").attr('disabled', false);
	}
	else
	{
		$("#sale_total").html("<?php echo to_currency($non_cash_total); ?>");
		$("#sale_amount_due").html("<?php echo to_currency($non_cash_amount_due); ?>");
		$("#amount_tendered_label").html("<?php echo $this->lang->line('sales_amount_tendered'); ?>");
		$("#amount_tendered:enabled").val('<?php echo to_currency_no_money($non_cash_amount_due); ?>');
		$(".giftcard-input").attr('disabled', true);
		$(".non-giftcard-input").attr('disabled', false);
	}
}
</script>

<?php $this->load->view("partial/footer");?>
