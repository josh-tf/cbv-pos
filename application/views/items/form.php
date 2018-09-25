<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>

<ul id="error_message_box" class="error_message_box"></ul>

<?php echo form_open('items/save/' . $item_info->item_id, array('id' => 'item_form', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal')); ?>
	<fieldset id="item_basic_info">
		<div class="form-group form-group-sm hidden">
			<?php echo form_label($this->lang->line('items_item_number'), 'item_number', array('class' => 'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<div class="input-group">
					<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-barcode"></span></span>
					<?php echo form_input(array(
    'name' => 'item_number',
    'id' => 'item_number',
    'class' => 'form-control input-sm',
    'value' => $item_info->item_number)
); ?>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_name'), 'name', array('class' => 'required control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<?php echo form_input(array(
    'name' => 'name',
    'id' => 'name',
    'class' => 'form-control input-sm',
    'value' => $item_info->name)
); ?>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_category'), 'category', array('class' => 'required control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<div class="input-group">
					<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-tag"></span></span>
					<?php echo form_input(array(
    'name' => 'category',
    'id' => 'category',
    'class' => 'form-control input-sm',
    'value' => $item_info->category)
); ?>
				</div>
			</div>
		</div>

		<?php if ($item_kits_enabled == '1'): ?>
		<div class="form-group form-group-sm hidden">
			<?php echo form_label($this->lang->line('items_stock_type'), 'stock_type', !empty($basic_version) ? array('class' => 'required control-label col-xs-3') : array('class' => 'control-label col-xs-3')); ?>
			<div class="col-xs-8">
				<label class="radio-inline">
					<?php echo form_radio(array(
    'name' => 'stock_type',
    'type' => 'radio',
    'id' => 'stock_type',
    'value' => 0,
    'checked' => $item_info->stock_type == HAS_STOCK)
); ?> <?php echo $this->lang->line('items_stock'); ?>
				</label>
				<label class="radio-inline">
					<?php echo form_radio(array(
    'name' => 'stock_type',
    'type' => 'radio',
    'id' => 'stock_type',
    'value' => 1,
    'checked' => $item_info->stock_type == HAS_NO_STOCK)
); ?> <?php echo $this->lang->line('items_nonstock'); ?>
				</label>
			</div>
		</div>

		<div class="form-group form-group-sm hidden">
			<?php echo form_label($this->lang->line('items_type'), 'item_type', !empty($basic_version) ? array('class' => 'required control-label col-xs-3') : array('class' => 'control-label col-xs-3')); ?>
			<div class="col-xs-8">
				<label class="radio-inline">
					<?php echo form_radio(array(
    'name' => 'item_type',
    'type' => 'radio',
    'id' => 'item_type',
    'value' => 0,
    'checked' => $item_info->item_type == ITEM)
); ?> <?php echo $this->lang->line('items_standard'); ?>
				</label>
				<label class="radio-inline">
					<?php echo form_radio(array(
    'name' => 'item_type',
    'type' => 'radio',
    'id' => 'item_type',
    'value' => 1,
    'checked' => $item_info->item_type == ITEM_KIT)
); ?> <?php echo $this->lang->line('items_kit'); ?>
				</label>
				<?php
if ($this->config->item('derive_sale_quantity') == '1') {
    ?>
					<label class="radio-inline">
						<?php echo form_radio(array(
        'name' => 'item_type',
        'type' => 'radio',
        'id' => 'item_type',
        'value' => 2,
        'checked' => $item_info->item_type == ITEM_AMOUNT_ENTRY)
    ); ?><?php echo $this->lang->line('items_amount_entry'); ?>
					</label>
				<?php
}
?>

			</div>
		</div>
		<?php endif;?>

		<div class="form-group form-group-sm hidden">
			<?php echo form_label($this->lang->line('items_supplier'), 'supplier', array('class' => 'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<?php echo form_dropdown('supplier_id', $suppliers, $selected_supplier, array('class' => 'form-control')); ?>
			</div>
		</div>

		<div class="form-group form-group-sm hidden">
			<?php echo form_label($this->lang->line('items_cost_price'), 'cost_price', array('class' => 'required control-label col-xs-3')); ?>
			<div class="col-xs-4">
				<div class="input-group input-group-sm">
					<?php if (!currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif;?>
					<?php echo form_input(array(
    'name' => 'cost_price',
    'id' => 'cost_price',
    'class' => 'form-control input-sm',
    'value' => to_currency_no_money($item_info->cost_price))
); ?>
					<?php if (currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif;?>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_unit_price'), 'unit_price', array('class' => 'required control-label col-xs-3')); ?>
			<div class='col-xs-4'>
				<div class="input-group input-group-sm">
					<?php if (!currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif;?>
					<?php echo form_input(array(
    'name' => 'unit_price',
    'id' => 'unit_price',
    'class' => 'form-control input-sm',
    'value' => to_currency_no_money($item_info->unit_price))
); ?>
					<?php if (currency_side()): ?>
						<span class="input-group-addon input-sm"><b><?php echo $this->config->item('currency_symbol'); ?></b></span>
					<?php endif;?>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_tax_1'), 'tax_percent_1', array('class' => 'control-label col-xs-3')); ?>
			<div class='col-xs-4'>
				<?php echo form_input(array(
    'name' => 'tax_names[]',
    'id' => 'tax_name_1',
    'class' => 'form-control input-sm',
    'value' => isset($item_tax_info[0]['name']) ? $item_tax_info[0]['name'] : $this->config->item('default_tax_1_name'))
); ?>
			</div>
			<div class="col-xs-4">
				<div class="input-group input-group-sm">
					<?php echo form_input(array(
    'name' => 'tax_percents[]',
    'id' => 'tax_percent_name_1',
    'class' => 'form-control input-sm',
    'value' => isset($item_tax_info[0]['percent']) ? to_tax_decimals($item_tax_info[0]['percent']) : to_tax_decimals($default_tax_1_rate))
); ?>
					<span class="input-group-addon input-sm"><b>%</b></span>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm hidden">
			<?php echo form_label($this->lang->line('items_tax_2'), 'tax_percent_2', array('class' => 'control-label col-xs-3')); ?>
			<div class='col-xs-4'>
				<?php echo form_input(array(
    'name' => 'tax_names[]',
    'id' => 'tax_name_2',
    'class' => 'form-control input-sm',
    'value' => isset($item_tax_info[1]['name']) ? $item_tax_info[1]['name'] : $this->config->item('default_tax_2_name'))
); ?>
			</div>
			<div class="col-xs-4">
				<div class="input-group input-group-sm">
					<?php echo form_input(array(
    'name' => 'tax_percents[]',
    'class' => 'form-control input-sm',
    'id' => 'tax_percent_name_2',
    'value' => isset($item_tax_info[1]['percent']) ? to_tax_decimals($item_tax_info[1]['percent']) : to_tax_decimals($default_tax_2_rate))
); ?>
					<span class="input-group-addon input-sm"><b>%</b></span>
				</div>
			</div>
		</div>

		<?php if ($customer_sales_tax_enabled) {?>
			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('taxes_tax_category'), 'tax_category', array('class' => 'control-label col-xs-3')); ?>
				<div class='col-xs-8'>
					<?php echo form_dropdown('tax_category_id', $tax_categories, $selected_tax_category, array('class' => 'form-control')); ?>
				</div>
			</div>
		<?php }?>

		<?php
define("DEFAULT_STOCK_LEVEL", 1);
foreach ($stock_locations as $key => $location_detail) {
    ?>
			<div class="form-group form-group-sm">
				<?php echo form_label($this->lang->line('items_quantity') . ' ' . $location_detail['location_name'], 'quantity_' . $key, array('class' => 'required control-label col-xs-3')); ?>
				<div class='col-xs-4'>
					<?php echo form_input(array(
        'name' => 'quantity_' . $key,
        'id' => 'quantity_' . $key,
        'class' => 'required quantity form-control',
        'value' => isset($item_info->item_id) ? to_quantity_decimals($location_detail['quantity']) : to_quantity_decimals(DEFAULT_STOCK_LEVEL))
    ); ?>
				</div>
			</div>
		<?php
}
?>

		<div class="form-group form-group-sm hidden">
			<?php echo form_label($this->lang->line('items_receiving_quantity'), 'receiving_quantity', array('class' => 'required control-label col-xs-3')); ?>
			<div class='col-xs-4'>
				<?php echo form_input(array(
    'name' => 'receiving_quantity',
    'id' => 'receiving_quantity',
    'class' => 'required form-control input-sm',
    'value' => isset($item_info->item_id) ? to_quantity_decimals($item_info->receiving_quantity) : to_quantity_decimals(0))
); ?>
			</div>
		</div>

		<div class="form-group form-group-sm hidden">
			<?php echo form_label($this->lang->line('items_reorder_level'), 'reorder_level', array('class' => 'required control-label col-xs-3')); ?>
			<div class='col-xs-4'>
				<?php echo form_input(array(
    'name' => 'reorder_level',
    'id' => 'reorder_level',
    'class' => 'form-control input-sm',
    'value' => isset($item_info->item_id) ? to_quantity_decimals($item_info->reorder_level) : to_quantity_decimals(0))
); ?>
			</div>
		</div>

		<div class="form-group form-group-sm hidden">
			<?php echo form_label($this->lang->line('items_image'), 'items_image', array('class' => 'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<div class="fileinput <?php echo $logo_exists ? 'fileinput-exists' : 'fileinput-new'; ?>" data-provides="fileinput">
					<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;"></div>
					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100px; max-height: 100px;">
						<img data-src="holder.js/100%x100%" alt="<?php echo $this->lang->line('items_image'); ?>"
							 src="<?php echo $image_path; ?>"
							 style="max-height: 100%; max-width: 100%;">
					</div>
					<div>
						<span class="btn btn-default btn-sm btn-file">
							<span class="fileinput-new"><?php echo $this->lang->line("items_select_image"); ?></span>
							<span class="fileinput-exists"><?php echo $this->lang->line("items_change_image"); ?></span>
							<input type="file" name="item_image" accept="image/*">
						</span>
						<a href="#" class="btn btn-default btn-sm fileinput-exists" data-dismiss="fileinput"><?php echo $this->lang->line("items_remove_image"); ?></a>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group form-group-sm hidden">
			<?php echo form_label($this->lang->line('items_allow_alt_description'), 'allow_alt_description', array('class' => 'control-label col-xs-3')); ?>
			<div class='col-xs-1'>
				<?php echo form_checkbox(array(
    'name' => 'allow_alt_description',
    'id' => 'allow_alt_description',
    'value' => 1,
    'checked' => ($item_info->allow_alt_description) ? 1 : 0)
); ?>
			</div>
		</div>

		<div class="form-group form-group-sm hidden">
			<?php echo form_label($this->lang->line('items_is_serialized'), 'is_serialized', array('class' => 'control-label col-xs-3')); ?>
			<div class='col-xs-1'>
				<?php echo form_checkbox(array(
    'name' => 'is_serialized',
    'id' => 'is_serialized',
    'value' => 1,
    'checked' => ($item_info->is_serialized) ? 1 : 0)
); ?>
			</div>
		</div>

		<div class="form-group form-group-sm hidden">
			<?php echo form_label($this->lang->line('items_is_deleted'), 'is_deleted', array('class' => 'control-label col-xs-3')); ?>
			<div class='col-xs-1'>
				<?php echo form_checkbox(array(
    'name' => 'is_deleted',
    'id' => 'is_deleted',
    'value' => 1,
    'checked' => ($item_info->deleted) ? 1 : 0)
); ?>
			</div>
		</div>

<?php
// add the custom step values and item types here - Defaults are `text` and `1`

$itemTypeInt = array('4', '5', '6', '8', '12'); //default type is text, put here for number/integer
$itemDate = array('1'); // default type is text, put here for date
$itemPartStep = array('4', '5', '8'); // default is 1, place here for 0.1 stepping value
?>


	<div id="computer-fields">
<?php
for ($i = 1; $i <= 20; ++$i) { //Loop through all 20 custom items in the DB
    if ($this->config->item('custom' . $i . '_name') != null) { // Only proceed if the item is notnull
        $item_arr = (array) $item_info;
        ?>
				<div class="form-group form-group-sm custom<?php echo $i; ?>">
					<?php echo form_label($this->config->item('custom' . $i . '_name'), 'custom' . $i, array('class' => 'control-label col-xs-3')); ?>
					<div class='col-xs-8'>
						<div class="input-group input-group-sm custom">
<?php
if ($i == 1) { //If its the Build Date field, show a calendar icon
            echo '<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-calendar"></span></span>';
        } elseif ($i == 12) { // If its the Box Price field then show a $ symbol
            echo '<span class="input-group-addon input-sm"><b>' . $this->config->item('currency_symbol') . '</b></span>';
        }
        ;

        $type = (in_array($i, $itemTypeInt) ? 'number' : //Check the itemTypeInt array for matching custom field ID
            (in_array($i, $itemDate) ? 'date' : 'text')); //Check the itemTypeDt array for matching custom field ID

        $step = (in_array($i, $itemPartStep)) ? 0.1 : 1; //Check the itemPartStep array for matching custom field ID
        // check for custom options, else use default

        $inputContents = array(
            'name' => 'custom' . $i,
            'id' => 'custom' . $i,
            'type' => $type,
            'step' => $step,
            'class' => 'form-control input-sm' . ' custom' . $i, // add the class for custom resizing of indv fields via css
            'value' => $item_arr['custom' . $i],
            'placeholder' => $this->lang->line('custom' . $i . '_helper')); //Add a placeholder example text from the lang file

        //Show a textarea instead of a input type for the "Other Notes" and "Extras" fields
        echo ($i == 13 || $i == 14 ? form_textarea($inputContents) : form_input($inputContents));

        $helperVal = ($i == 4 ? 'GHz' : //Custom 4 is CPU Speed
            ($i == 5 || $i == 6 ? 'GB' : // Custom 5 RAM, Custom 6 Storage
                ($i == 8 ? 'Inches' : // Custom 8 is screen size
                    ($i == 11 ? 'Hours' : null)))); // Custom 11 is Battery life, otherwise no return

        //only print if returned value
        if (isset($helperVal)) {echo '<span class="input-group-addon input-sm">' . $helperVal . '</span>';}
        ;
        ?>
						</div>
					</div>
				</div>
<?php
}
}
?>
	</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('items_description'), 'description', array('class' => 'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<?php echo form_textarea(array(
    'name' => 'description',
    'id' => 'description',
    'class' => 'form-control input-sm',
    'value' => $item_info->description)
); ?>
			</div>
		</div>
	</fieldset>
<?php echo form_close(); ?>

<script type="text/javascript">
//validation and submit handling
$(document).ready(function()
{
	const TAXABLE_CATEGORIES = ['Support', 'Miscellaneous-new'];
	const NON_STOCKED_CATEGORIES = ['Support'];
	const COMPUTER_CATEGORIES = ['Laptop', 'Desktop'];
	const DEFAULT_TAX_RATE = '<?php echo to_tax_decimals($default_tax_1_rate); ?>';
	const updateFieldsBasedOnCategory = () => {
		let category = $('#category').val();
		let isComputer = COMPUTER_CATEGORIES.indexOf(category) !== -1;
		let isStocked = NON_STOCKED_CATEGORIES.indexOf(category) === -1;

		if (isComputer) {
			$('#computer-fields').removeClass('hidden');
		} else {
			$('#computer-fields').addClass('hidden');
		}

		if (category == 'Desktop') { // isComputer and is a Desktop (Specific items: 10,12)
			$('.custom10').removeClass('hidden');
			$('.custom12').removeClass('hidden');
			$('.custom11').addClass('hidden');
		} else { // isComputer (above logic) and now is a laptop (Specific items: 11)
			$('.custom10').addClass('hidden');
			$('.custom12').addClass('hidden');
			$('.custom11').removeClass('hidden');
		}

		// Querying radio buttons by id will only return the first element http://www.mkyong.com/jquery/how-to-select-a-radio-button-with-jquery/
		$('input:radio[name=stock_type]')[0].checked = isStocked;
		$('input:radio[name=stock_type]')[1].checked = !isStocked;
	};
	updateFieldsBasedOnCategory(); // Run as soon as document is ready

	$("#new").click(function() {
		stay_open = true;
		$("#item_form").submit();
	});

	$("#submit").click(function() {
		stay_open = false;
	});

	var no_op = function(event, data, formatted){};
	$("#category").autocomplete({source: "<?php echo site_url('items/suggest_category'); ?>",delay:10,appendTo: '.modal-content'});

	// Update tax percent after category changes
	$("#category").blur(function(eventObject) {
		var category = $(this).val();
		var taxRate = '0.00';

		if (TAXABLE_CATEGORIES.indexOf(category) !== -1) {
			taxRate = DEFAULT_TAX_RATE;
		}

		$('#tax_percent_name_1').val(taxRate);

		updateFieldsBasedOnCategory(); // Check whether we should hide the custom fields
	});

function createDescription() {

	// has to be a cleaner way..
	var cat = "" // $('#category').val(); - this is already shown on reciept from diff function refer to reciept_default.php #Line 117
	var c1 = "" //$('#custom1').val(); Don't show the build date on description
	var c2 = $('#custom2').val();
	var c3 = $('#custom3').val();
	var c4 = $('#custom4').val();
	var c5 = $('#custom5').val();
	var c6 = $('#custom6').val();
	var c7 = $('#custom7').val();
	var c8 = $('#custom8').val();
	var c9 = $('#custom9').val();
	var c10 = $('#custom10').val();
	var c11 = $('#custom11').val();
	var c12 = "" // $('#custom12').val(); -- dont include boxonly price in description
	var c13 = $('#custom13').val();
	var c14 = "" //$('#custom14').val(); -- Removed as this is the staff only notes field
	var c15 = $('#custom15').val();
	var c16 = $('#custom16').val();
	var c17 = $('#custom17').val();
	var c18 = $('#custom18').val();
	var c19 = $('#custom19').val();
	var c20 = $('#custom20').val();

	// Add on the extentions only if notnull - important for the next step

	if(c10){cat += ' ('+c10+')';} // if type (i.e All in One) specified, it will be displayed as "Desktop (All in One) in the description"

	if(c4){c4 += ' Ghz';} //Add in Ghz on the CPU Speed field
	if(c5){c5 += ' GB RAM';} // Add in GB RAM to the RAM field
	if(c6){c6 += ' GB HDD';} // Add in GB HDD to the Storage field
	if(c8){c8 += ' Inches';}  //  Add in Inches to the Screen field
	if(c11){c11 += ' Hours';}  //  Add in Hours to Battery field

	// Contact all fields together if they are not null
	return $.grep([cat, c1, c2, c3, c4, c5, c6, c7, c8, c9, c11, c12, c13, c14, c15, c16, c17, c18, c19, c20], Boolean).join(", "); // skip c10 as its included in cat string

};
	// Update description
	$('#computer-fields').change(() => {

		$('#description').val(createDescription); //createDescription();

});

	<?php for ($i = 1; $i <= 20; ++$i) {
    ?>
		$("#custom" + <?php echo $i; ?>).autocomplete({
			source:function (request, response) {
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('items/suggest_custom'); ?>",
					dataType: "json",
					data: $.extend(request, $.extend(csrf_form_base(), {field_no: <?php echo $i; ?>})),
					success: function(data) {
						response($.map(data, function(item) {
							return {
								value: item.label
							};
						}))
					}
				});
			},
			delay: 10,
			appendTo: '.modal-content'});
	<?php
}
?>

	$("a.fileinput-exists").click(function() {
		$.ajax({
			type: "GET",
			url: "<?php echo site_url("$controller_name/remove_logo/$item_info->item_id"); ?>",
			dataType: "json"
		})
	});

	$('#item_form').validate($.extend({
		submitHandler: function(form, event) {
			$(form).ajaxSubmit({
				success: function(response) {
					var stay_open = dialog_support.clicked_id() != 'submit';
					if (stay_open)
					{
						// set action of item_form to url without item id, so a new one can be created
						$("#item_form").attr("action", "<?php echo site_url("items/save/") ?>");
						// use a whitelist of fields to minimize unintended side effects
						$(':text, :password, :file, #description, #item_form').not('.quantity, #reorder_level, #tax_name_1,' +
							'#tax_percent_name_1, #reference_number, #name, #cost_price, #unit_price, #taxed_cost_price, #taxed_unit_price').val('');
						// de-select any checkboxes, radios and drop-down menus
						$(':input', '#item_form').not('#item_category_id').removeAttr('checked').removeAttr('selected');
					}
					else
					{
						dialog_support.hide();
					}
					table_support.handle_submit('<?php echo site_url('items'); ?>', response, stay_open);
				},
				dataType: 'json'
			});
		},

		rules:
		{
			name: "required",
			category: "required",
			item_number:
			{
				required: false,
				remote:
				{
					url: "<?php echo site_url($controller_name . '/check_item_number') ?>",
					type: "post",
					data: $.extend(csrf_form_base(),
					{
						"item_id": "<?php echo $item_info->item_id; ?>",
						"item_number": function()
						{
							return $("#item_number").val();
						},
					})
				}
			},
			cost_price:
			{
				required: true,
				remote: "<?php echo site_url($controller_name . '/check_numeric') ?>"
			},
			unit_price:
			{
				required: true,
				remote: "<?php echo site_url($controller_name . '/check_numeric') ?>"
			},
			<?php
foreach ($stock_locations as $key => $location_detail) {
    ?>
				<?php echo 'quantity_' . $key ?>:
				{
					required: true,
					remote: "<?php echo site_url($controller_name . '/check_numeric') ?>"
				},
			<?php
}
?>
			receiving_quantity:
			{
				required: true,
				remote: "<?php echo site_url($controller_name . '/check_numeric') ?>"
			},
			reorder_level:
			{
				required: true,
				remote: "<?php echo site_url($controller_name . '/check_numeric') ?>"
			},
			tax_percent:
			{
				required: true,
				remote: "<?php echo site_url($controller_name . '/check_numeric') ?>"
			}
		},

		messages:
		{
			name: "<?php echo $this->lang->line('items_name_required'); ?>",
			item_number: "<?php echo $this->lang->line('items_item_number_duplicate'); ?>",
			category: "<?php echo $this->lang->line('items_category_required'); ?>",
			cost_price:
			{
				required: "<?php echo $this->lang->line('items_cost_price_required'); ?>",
				number: "<?php echo $this->lang->line('items_cost_price_number'); ?>"
			},
			unit_price:
			{
				required: "<?php echo $this->lang->line('items_unit_price_required'); ?>",
				number: "<?php echo $this->lang->line('items_unit_price_number'); ?>"
			},
			<?php
foreach ($stock_locations as $key => $location_detail) {
    ?>
				<?php echo 'quantity_' . $key ?>:
				{
					required: "<?php echo $this->lang->line('items_quantity_required'); ?>",
					number: "<?php echo $this->lang->line('items_quantity_number'); ?>"
				},
			<?php
}
?>
			receiving_quantity:
			{
				required: "<?php echo $this->lang->line('items_quantity_required'); ?>",
				number: "<?php echo $this->lang->line('items_quantity_number'); ?>"
			},
			reorder_level:
			{
				required: "<?php echo $this->lang->line('items_reorder_level_required'); ?>",
				number: "<?php echo $this->lang->line('items_reorder_level_number'); ?>"
			},
			tax_percent:
			{
				required: "<?php echo $this->lang->line('items_tax_percent_required'); ?>",
				number: "<?php echo $this->lang->line('items_tax_percent_number'); ?>"
			}
		}
	}, form_support.error));
});
</script>