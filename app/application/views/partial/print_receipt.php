<script type="text/javascript">
    function printdoc() {
        $('#printWarning').modal('hide');
		$('#printWarning').on('hidden.bs.modal', function (e) {
			window.print(); // print once the modal has been hidden
})
    }

<?php
if ($print_after_sale) {
    ?>
	$(window).load(function()
	{
	   // executes when complete page is fully loaded, including all frames, objects and images
	   $('#printWarning').modal('show');
	});
<?php
}
?>
</script>