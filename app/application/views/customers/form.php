<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>

<ul id="error_message_box" class="error_message_box"></ul>

<?php echo form_open($controller_name . '/save/' . $person_info->person_id, array('id' => 'customer_form', 'class' => 'form-horizontal')); ?>
	<ul class="nav nav-tabs nav-justified" data-tabs="tabs">
		<li class="active" role="presentation">
			<a data-toggle="tab" href="#customer_basic_info"><?php echo $this->lang->line("customers_basic_information"); ?></a>
		</li>
		<?php
if (!empty($stats)) {
    ?>
			<li role="presentation">
				<a data-toggle="tab" href="#customer_stats_info"><?php echo $this->lang->line("customers_stats_info"); ?></a>
			</li>
		<?php
}
?>
	</ul>

	<div class="tab-content">
		<div class="tab-pane fade in active" id="customer_basic_info">

			<fieldset>

				<div class="form-group form-group-sm">
					<?php echo form_label($this->lang->line('customers_conc_id'), 'conc_id', array('class' => 'control-label col-xs-3')); ?>
					<div class='col-xs-6'>
						<div class="input-group input-group-sm">
							<span class="input-group-addon input-sm"><b>CRN</b></span>
							<?php echo form_input(array(
    'name' => 'conc_id',
    'id' => 'conc_id',
    'class' => 'form-control input-sm',
    'value' => $person_info->conc_id)
); ?>
						</div>
					</div>

						<div class="lookup">

<!-- Look up Customer ID -->
<?php
$submitLabel = array(
    'class' => 'lookupConc',
    'onClick' => 'conc_check_form.submit()',
);

echo form_label('Lookup', 'conc_id', $submitLabel);
echo form_close();
?>

                        </div>
					</div>

                    </div>

				<?php $this->load->view("people/form_basic_info");?>

				<?php if ($this->config->item('customer_reward_enable') == true): ?>
					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('rewards_package'), 'rewards', array('class' => 'control-label col-xs-3')); ?>
						<div class='col-xs-8'>
							<?php echo form_dropdown('package_id', $packages, $selected_package, array('class' => 'form-control')); ?>
						</div>
					</div>

					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('customers_available_points'), 'available_points', array('class' => 'control-label col-xs-3')); ?>
						<div class='col-xs-4'>
							<?php echo form_input(array(
    'name' => 'available_points',
    'id' => 'available_points',
    'class' => 'form-control input-sm',
    'value' => $person_info->points,
    'disabled' => '')
); ?>
						</div>
					</div>
				<?php endif;?>

				</fieldset>
		</div>

		<?php
if (!empty($stats)) {
    ?>
			<div class="tab-pane" id="customer_stats_info">
				<fieldset>

					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('customers_total'), 'total', array('class' => 'control-label col-xs-3')); ?>
						<div class="col-xs-4">
							<div class="input-group input-group-sm">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif;?>
								<?php echo form_input(array(
        'name' => 'total',
        'id' => 'total',
        'class' => 'form-control input-sm',
        'value' => to_currency_no_money($stats->total),
        'disabled' => '')
    ); ?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif;?>
							</div>
						</div>
					</div>


					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('customers_max'), 'max', array('class' => 'control-label col-xs-3')); ?>
						<div class="col-xs-4">
							<div class="input-group input-group-sm">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif;?>
								<?php echo form_input(array(
        'name' => 'max',
        'id' => 'max',
        'class' => 'form-control input-sm',
        'value' => to_currency_no_money($stats->max),
        'disabled' => '')
    ); ?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif;?>
							</div>
						</div>
					</div>

					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('customers_min'), 'min', array('class' => 'control-label col-xs-3')); ?>
						<div class="col-xs-4">
							<div class="input-group input-group-sm">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif;?>
								<?php echo form_input(array(
        'name' => 'min',
        'id' => 'min',
        'class' => 'form-control input-sm',
        'value' => to_currency_no_money($stats->min),
        'disabled' => '')
    ); ?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif;?>
							</div>
						</div>
					</div>

					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('customers_average'), 'average', array('class' => 'control-label col-xs-3')); ?>
						<div class="col-xs-4">
							<div class="input-group input-group-sm">
								<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif;?>
								<?php echo form_input(array(
        'name' => 'average',
        'id' => 'average',
        'class' => 'form-control input-sm',
        'value' => to_currency_no_money($stats->average),
        'disabled' => '')
    ); ?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif;?>
							</div>
						</div>
					</div>

					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('customers_quantity'), 'quantity', array('class' => 'control-label col-xs-3')); ?>
						<div class="col-xs-4">
							<div class="input-group input-group-sm">
								<?php echo form_input(array(
        'name' => 'quantity',
        'id' => 'quantity',
        'class' => 'form-control input-sm',
        'value' => $stats->quantity,
        'disabled' => '')
    ); ?>
							</div>
						</div>
					</div>

					<div class="form-group form-group-sm">
						<?php echo form_label($this->lang->line('customers_total_discount'), 'total_discount', array('class' => 'control-label col-xs-3')); ?>
						<div class="col-xs-4">
							<div class="input-group input-group-sm">
							<?php if (!currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif;?>
								<?php echo form_input(array(
        'name' => 'total_discount',
        'id' => 'total_discount',
        'class' => 'form-control input-sm',
        'value' => $stats->total_discount,
        'disabled' => '')
    ); ?>
								<?php if (currency_side()): ?>
									<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
								<?php endif;?>
							</div>
						</div>
					</div>
				</fieldset>
			</div>
		<?php
}
?>
	</div>


	<?php if ($customer_sales_tax_enabled) {?>
		<div class="form-group  form-group-sm">
			<?php echo form_label($this->lang->line('customers_tax_code'), 'sales_tax_code_name', array('class' => 'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<div class="input-group input-group-sm">
					<?php echo form_input(array(
    'name' => 'sales_tax_code_name',
    'id' => 'sales_tax_code_name',
    'class' => 'form-control input-sm',
    'size' => '50',
    'value' => $sales_tax_code_label)
); ?>
					<?php echo form_hidden('sales_tax_code', $person_info->sales_tax_code); ?>
				</div>
			</div>
		</div>
	<?php }?>
<?php echo form_close(); ?>

<script type="text/javascript">
//validation and submit handling
$(document).ready(function()
{
	$("#conc_id").on('change keydown paste input', function(){
		document.getElementById("conc_id_check").value = document.getElementById("conc_id").value // helper val used for post/form request
	});
	$('.modal').on('hidden.bs.modal', function (e) {
		document.getElementById("conc_id_check").value = "Concession ID:";
	});
	$('#customer_form').validate($.extend({
		submitHandler: function(form)
		{
			$(form).ajaxSubmit({
				success: function(response)
				{
					//dialog_support.hide();
					table_support.handle_submit('<?php echo site_url($controller_name); ?>', response);

					if(response.success){
						dialog_support.hide();
					}
				},
				dataType: 'json'
			});
		},

		rules:
		{
			first_name: "required",
			last_name: "required",
    		email:
			{
				remote:
				{
					url: "<?php echo site_url($controller_name . '/ajax_check_email') ?>",
					type: "post",
					data: $.extend(csrf_form_base(),
					{
						"person_id" : "<?php echo $person_info->person_id; ?>",
						// email is posted by default
					})
				}
			},
    		conc_id:
			{
				remote:
				{
					url: "<?php echo site_url($controller_name . '/ajax_check_conc_id') ?>",
					type: "post",
					data: $.extend(csrf_form_base(),
					{
						"person_id" : "<?php echo $person_info->person_id; ?>"
						// conc_id is posted by default
					})
				}
			}
   		},

		messages:
		{
     		first_name: "<?php echo $this->lang->line('common_first_name_required'); ?>",
     		last_name: "<?php echo $this->lang->line('common_last_name_required'); ?>",
     		email: "<?php echo $this->lang->line('customers_email_duplicate'); ?>",
			 conc_id: "<?php echo $this->lang->line('customers_conc_id_duplicate'); ?>"
		}
	}, form_support.error));
});

$("input[name='sales_tax_code_name']").change(function() {
    if( ! $("input[name='sales_tax_code_name']").val() ) {
        $("input[name='sales_tax_code']").val('');
    }
});

var fill_value = function(event, ui) {
    event.preventDefault();
    $("input[name='sales_tax_code']").val(ui.item.value);
    $("input[name='sales_tax_code_name']").val(ui.item.label);
};

$("#sales_tax_code_name").autocomplete({
    source: '<?php echo site_url("taxes/suggest_sales_tax_codes"); ?>',
    minChars: 0,
    delay: 15,
    cacheLength: 1,
    appendTo: '.modal-content',
    select: fill_value,
    focus: fill_value
});

</script>
