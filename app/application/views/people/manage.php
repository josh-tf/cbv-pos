<?php $this->load->view("partial/header");?>

<script type="text/javascript">
$(document).ready(function()
{
	<?php $this->load->view('partial/bootstrap_tables_locale');?>

	table_support.init({
		resource: '<?php echo site_url($controller_name); ?>',
		headers: <?php echo $table_headers; ?>,
		pageSize: <?php echo $this->config->item('lines_per_page'); ?>,
		uniqueId: 'people.person_id',
		enableActions: function()
		{
			var email_disabled = $("td input:checkbox:checked").parents("tr").find("td a[href^='mailto:']").length == 0;
			$("#email").prop('disabled', email_disabled);
		}
	});

	$("#email").click(function(event)
	{
		var recipients = $.map($("tr.selected a[href^='mailto:']"), function(element)
		{
			return $(element).attr('href').replace(/^mailto:/, '');
		});
		location.href = "mailto:" + recipients.join(",");
	});

$('#conc_check_form').submit(function() {
    if ($.trim($("#conc_id_check").val()) === "" || $.trim($("#conc_id_check").val()) === "<?php echo $this->lang->line('lookup_conc_id_default') ?>") {
		$("#conc_id_check").focus();
        return false; // ignore if nothing entered
    }
});
});

</script>

<div id="title_bar" class="btn-toolbar">
	<?php
if ($controller_name == 'customers') {
    ?>
		<button class='btn btn-info btn-sm pull-right modal-dlg' data-btn-submit='<?php echo $this->lang->line('common_submit') ?>' data-href='<?php echo site_url($controller_name . "/excel_import"); ?>'
				title='<?php echo $this->lang->line('customers_import_items_excel'); ?>'>
			<span class="glyphicon glyphicon-import">&nbsp</span><?php echo $this->lang->line('common_import_excel'); ?>
		</button>
	<?php
}
?>
	<button class='btn btn-info btn-sm pull-right modal-dlg' data-btn-submit='<?php echo $this->lang->line('common_submit') ?>' data-href='<?php echo site_url($controller_name . "/view"); ?>'
			title='<?php echo $this->lang->line($controller_name . '_new'); ?>'>
		<span class="glyphicon glyphicon-user">&nbsp</span><?php echo $this->lang->line($controller_name . '_new'); ?>
	</button>

<!-- Look up Customer ID -->
<?php if ($controller_name == 'customers') {

    echo form_open(base_url('/customers/lookup/'), array('id' => 'conc_check_form', 'class' => 'conc_check_form'));

    $btnContent = '<span class="glyphicon glyphicon-file">&nbsp</span>' . $this->lang->line('lookup_conc_id');

    echo form_button(['type' => 'submit', 'id' => 'conc_check_btn', 'content' => $btnContent, 'class' => 'btn btn-info btn-sm pull-right']);
    echo form_input(['type' => 'text', 'id' => 'conc_id_check', 'name' => 'conc_id_check', 'value' => $this->lang->line('lookup_conc_id_default'), 'class' => 'form-control input-sm conc_id_check', 'onFocus' => 'this.value=\'\'']);

    echo form_close();
}
?>
</div>

</div>

<div id="toolbar">
	<div class="pull-left btn-toolbar">
		<button id="delete" class="btn btn-default btn-sm">
			<span class="glyphicon glyphicqon-trash">&nbsp</span><?php echo $this->lang->line("common_delete"); ?>
		</button>
		<button id="email" class="btn btn-default btn-sm">
			<span class="glyphicon glyphicon-envelope">&nbsp</span><?php echo $this->lang->line("common_email"); ?>
		</button>
	</div>
</div>

<div id="table_holder">
	<table id="table"></table>
</div>


<?php $this->load->view("partial/footer");?>
