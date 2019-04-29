<?php $this->load->view("partial/header");?>

<div id="page_title"><?php echo $title ?></div>

<div id="page_subtitle"><?php echo $subtitle ?></div>

<div id="table_holder">
	<table id="table"></table>
</div>

<div id="report_summary">
	<?php
foreach ($overall_summary_data as $name => $value) {
    ?>
		<div class="summary_row"><?php echo $this->lang->line('reports_' . $name) . ': ' . to_currency($value); ?></div>
	<?php
}
?>
</div>

<script type="text/javascript">
	$(document).ready(function()
	{

	 	<?php $this->load->view('partial/bootstrap_tables_locale');?>

		var details_data = <?php echo json_encode($details_data); ?>;

		var init_dialog = function() {
			<?php
if (isset($editable)) {
    ?>
				table_support.submit_handler('<?php echo site_url("reports/get_detailed_computers_row") ?>');
				dialog_support.init("a.modal-dlg");
			<?php
}
?>
		};

		$('#table').bootstrapTable({
			columns: <?php echo transform_headers($headers['summary'], true, false); ?>,
			stickyHeader: true,
			pageSize: <?php echo $this->config->item('lines_per_page'); ?>,
			striped: true,
			pagination: true,
			sortable: true,
			search: true,
			showColumns: true,
			uniqueId: 'id',
			showExport: true,
			exportDataType: 'all',
			exportTypes: ['json', 'xml', 'csv', 'txt', 'sql', 'excel', 'pdf'],
			data: <?php echo json_encode($summary_data); ?>,
			iconSize: 'sm',
			paginationVAlign: 'bottom',
			detailView: false,
			escape: false,
			onPageChange: init_dialog,
			onPostBody: function() {
				dialog_support.init("a.modal-dlg");
				$('[data-toggle="tooltip"]').tooltip();
			},
		});

		init_dialog();
	});
</script>

<?php $this->load->view("partial/footer");?>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>