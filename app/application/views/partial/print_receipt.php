<script type="text/javascript">
function printdoc(){
	$('#printWarning').modal('hide');
		window.print();
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