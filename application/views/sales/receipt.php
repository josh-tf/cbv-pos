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
To ensure the recept is printed correctly, please ensure
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
      <td>Landscape</td>
    </tr>
    <tr>
      <th scope="row">Scaling</th>
      <td colspan="2">85%</td>
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
		$.get('<?php echo site_url() . "/sales/send_receipt/" . $sale_id_num; ?>',
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
	<?php /* this line will allow to print and go back to sales automatically.... echo anchor("sales", '<span class="glyphicon glyphicon-print">&nbsp</span>' . $this->lang->line('common_print'), array('class'=>'btn btn-info btn-sm', 'id'=>'show_print_button', 'onclick'=>'window.print();')); */?>
	<?php if (isset($customer_email) && !empty($customer_email)): ?>
		<a href="javascript:void(0);"><div class="btn btn-info btn-sm", id="show_email_button"><?php echo '<span class="glyphicon glyphicon-envelope">&nbsp</span>' . $this->lang->line('sales_send_receipt'); ?></div></a>
	<?php endif;?>
	<?php echo anchor("sales", '<span class="glyphicon glyphicon-shopping-cart">&nbsp</span>' . $this->lang->line('sales_register'), array('class' => 'btn btn-info btn-sm', 'id' => 'show_sales_button')); ?>
	<?php echo anchor("sales/manage", '<span class="glyphicon glyphicon-list-alt">&nbsp</span>' . $this->lang->line('sales_takings'), array('class' => 'btn btn-info btn-sm', 'id' => 'show_takings_button')); ?>
</div>

<?php $this->load->view("sales/" . $this->config->item('receipt_template'));?>

<?php $this->load->view("partial/footer");?>