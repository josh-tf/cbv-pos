<?php $this->load->view("partial/header");?>

<?php
if (isset($error_message)) {
    echo "<div class='alert alert-dismissible alert-danger'>" . $error_message . "</div>";
    exit;
}
?>
<!-- Modal -->
<div class="modal bootstrap-dialog modal-dlg type-primary fade size-normal in" id="printWarning" tabindex="-1" role="dialog" aria-labelledby="printWarningLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="bootstrap-dialog-header">
                    <div class="bootstrap-dialog-close-button" style="display: block;">
                        <button class="close" aria-label="close">×</button>
                    </div>
                    <div class="bootstrap-dialog-title">Printer Settings</div>
                </div>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading"><b>Important Notice</b></h4>
                    <p style="font-size: 13px;">To ensure the receipt is printed correctly, please ensure the printer settings in the popup dialog are configured as follows:</p>
                </div>
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
                <button type="button" onclick="printdoc();" class="btn btn-primary">Print Receipt</button>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($customer_email)): ?>
<script type="text/javascript">
$(document).ready(function()
{
	var send_email = function()
	{
		$.get('<?php echo site_url() . "/sales/send_pdf/" . $sale_id_num . '/receipt'; ?>',
			function(response)
			{
				$.notify(response.message, { type: response.success ? 'success' : 'danger'} );
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

<?php $this->load->view('partial/print_receipt', array('print_after_sale' => $print_after_sale, 'selected_printer' => 'receipt_printer'));?>

<div class="print_hide" id="control_buttons" style="text-align:right">
	<a data-toggle="modal" data-target="#printWarning"><div class="btn btn-info btn-sm", id="show_print_button"><?php echo '<span class="glyphicon glyphicon-print">&nbsp</span>' . $this->lang->line('common_print'); ?></div></a>
	<?php echo anchor("sales/save_pdf/" . $sale_id_num . '/receipt', '<span class="glyphicon glyphicon-download">&nbsp</span>' . $this->lang->line('common_save_pdf'), array('class' => 'btn btn-info btn-sm', 'id' => 'show_save_button')); ?>
	<?php if (isset($customer_email) && !empty($customer_email)): ?>
		<a href="javascript:void(0);"><div class="btn btn-info btn-sm", id="show_email_button"><?php echo '<span class="glyphicon glyphicon-envelope">&nbsp</span>' . $this->lang->line('sales_send_receipt'); ?></div></a>
	<?php endif;?>
	<?php echo anchor("sales", '<span class="glyphicon glyphicon-shopping-cart">&nbsp</span>' . $this->lang->line('sales_register'), array('class' => 'btn btn-info btn-sm', 'id' => 'show_sales_button')); ?>
	<?php echo anchor("sales/manage", '<span class="glyphicon glyphicon-list-alt">&nbsp</span>' . $this->lang->line('sales_takings'), array('class' => 'btn btn-info btn-sm', 'id' => 'show_takings_button')); ?>
</div>

<?php $this->load->view("sales/" . $this->config->item('receipt_template'));?>

<?php $this->load->view("partial/footer");?>