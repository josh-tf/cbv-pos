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
    <select class="form-control input-sm" id="category" name="category">
	<option selected disabled>Please Select..</option>
	<?php

$variable = $this->config->item('cbvopt_item_cat');
$var = explode(',', $variable);

foreach ($var as $row) {
    echo '<option>' . trim($row) . '</option>';
}
?>
    </select>
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

		<div class="form-group form-group-sm" id="tax">
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
						<img data-src="holder.js/100%x100%" alt="<?php echo $this->lang->line('items_image'); ?>" src="<?php echo $image_path; ?>"" style="max-height: 100%; max-width: 100%;">
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
	<div id="computer-fields">

<?php

$item_arr = (array) $item_info; // if editing, get the item data

?>

<div class="form-group form-group-sm custom1">
<?php echo form_label($this->config->item('custom1_name'), 'custom1', array('class' => 'control-label col-xs-3')); ?>
<div class='col-xs-8'>
<div class="input-group input-group-sm custom">
<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-calendar"></span></span>
<input value="<?php echo $item_arr['custom1'] ?>" list="custom1" class="form-control input-sm" name="custom1" type="date" id="custom1">
</div>
</div>
</div>

<div class="form-group form-group-sm custom2">
<?php echo form_label($this->config->item('custom2_name'), 'custom2', array('class' => 'control-label col-xs-3')); ?>
<div class='col-xs-8'>
<div class="input-group input-group-sm custom">
<input value="<?php echo $item_arr['custom2'] ?>" placeholder="<?php echo $this->lang->line('custom2_helper') ?>" list="custom2" class="form-control input-sm" name="custom2" id="custom2">
</div>
</div>
</div>

<div class="form-group form-group-sm custom3">
<?php echo form_label($this->config->item('custom3_name'), 'custom3', array('class' => 'control-label col-xs-3')); ?>
<div class='col-xs-8'>
<div class="input-group input-group-sm custom">
<input value="<?php echo $item_arr['custom3'] ?>" placeholder="<?php echo $this->lang->line('custom3_helper') ?>" list="custom3" class="form-control input-sm" name="custom3">
<datalist id="custom3">

<?php
$variable = $this->config->item('cbvopt_item_cpu');
$var = explode(',', $variable);

foreach ($var as $row) {
    echo '<option value="' . trim($row) . '">';
}
?>

</datalist>
</div>
</div>
</div>

<div class="form-group form-group-sm custom4">
<?php echo form_label($this->config->item('custom4_name'), 'custom4', array('class' => 'control-label col-xs-3')); ?>
<div class='col-xs-8'>
<div class="input-group input-group-sm custom">
<input value="<?php echo $item_arr['custom4'] ?>" placeholder="<?php echo $this->lang->line('custom4_helper') ?>" list="custom4" class="form-control input-sm" name="custom4" id="custom4" type="number" step="0.1">
<span class="input-group-addon input-sm">Ghz</span>
</div>
</div>
</div>

<div class="form-group form-group-sm custom5">
<?php echo form_label($this->config->item('custom5_name'), 'custom5', array('class' => 'control-label col-xs-3')); ?>
<div class='col-xs-8'>
<div class="input-group input-group-sm custom">
<input value="<?php echo $item_arr['custom5'] ?>" placeholder="<?php echo $this->lang->line('custom5_helper') ?>" list="custom5" class="form-control input-sm" name="custom5">
<datalist id="custom5">

<?php
$variable = $this->config->item('cbvopt_item_ram');
$var = explode(',', $variable);

foreach ($var as $row) {
    echo '<option value="' . trim($row) . '">';
}
?>

</datalist>
<span class="input-group-addon input-sm">GB</span>
</div>
</div>
</div>

<div class="form-group form-group-sm custom6">
<?php echo form_label($this->config->item('custom6_name'), 'custom6', array('class' => 'control-label col-xs-3')); ?>
<div class='col-xs-8'>
<div class="input-group input-group-sm custom">
<input value="<?php echo $item_arr['custom6'] ?>" placeholder="<?php echo $this->lang->line('custom6_helper') ?>" list="custom6" class="form-control input-sm" name="custom6">
<datalist id="custom6">

<?php
$variable = $this->config->item('cbvopt_item_storage');
$var = explode(',', $variable);

foreach ($var as $row) {
    echo '<option value="' . trim($row) . '">';
}
?>
</datalist>
<span class="input-group-addon input-sm">GB</span>
</div>
</div>
</div>

<div class="form-group form-group-sm custom7">
<?php echo form_label($this->config->item('custom7_name'), 'custom7', array('class' => 'control-label col-xs-3')); ?>
<div class='col-xs-8'>
<div class="input-group input-group-sm custom">
<select class="form-control input-sm" id="custom7" name="custom7">
	<option selected disabled>Please Select..</option>
	<?php
$variable = $this->config->item('cbvopt_item_os');
$var = explode(',', $variable);

foreach ($var as $row) {
    echo '<option>' . trim($row) . '</option>';
}
?>
    </select>

</div>
</div>
</div>

<div class="form-group form-group-sm custom8">
<?php echo form_label($this->config->item('custom8_name'), 'custom8', array('class' => 'control-label col-xs-3')); ?>
<div class='col-xs-8'>
<div class="input-group input-group-sm custom">
<input value="<?php echo $item_arr['custom8'] ?>" placeholder="<?php echo $this->lang->line('custom8_helper') ?>" list="custom8" class="form-control input-sm" name="custom8">
<datalist id="custom8">

<?php
$variable = $this->config->item('cbvopt_item_screen');
$var = explode(',', $variable);

foreach ($var as $row) {
    echo '<option value="' . trim($row) . '">';
}
?>
</datalist>
<span class="input-group-addon input-sm">Inches</span>
</div>
</div>
</div>

<div class="form-group form-group-sm custom9">
<?php echo form_label($this->config->item('custom9_name'), 'custom9', array('class' => 'control-label col-xs-3')); ?>
<div class='col-xs-8'>
<div class="input-group input-group-sm custom">
<input value="<?php echo $item_arr['custom9'] ?>" placeholder="<?php echo $this->lang->line('custom9_helper') ?>" list="custom9" class="form-control input-sm" name="custom9">
<datalist id="custom9">

<?php
$variable = $this->config->item('cbvopt_item_optical');
$var = explode(',', $variable);

foreach ($var as $row) {
    echo '<option value="' . trim($row) . '">';
}
?>
</datalist>
</div>
</div>
</div>

<div class="form-group form-group-sm custom10">
<?php echo form_label($this->config->item('custom10_name'), 'custom10', array('class' => 'control-label col-xs-3')); ?>
<div class='col-xs-8'>
<div class="input-group input-group-sm custom">
<input value="<?php echo $item_arr['custom10'] ?>" placeholder="<?php echo $this->lang->line('custom10_helper') ?>" list="custom10" class="form-control input-sm" name="custom10">
<datalist id="custom10">

<?php
$variable = $this->config->item('cbvopt_item_type');
$var = explode(',', $variable);

foreach ($var as $row) {
    echo '<option value="' . trim($row) . '">';
}
?>

</datalist>
</div>
</div>
</div>

<div class="form-group form-group-sm custom11">
<?php echo form_label($this->config->item('custom11_name'), 'custom11', array('class' => 'control-label col-xs-3')); ?>
<div class='col-xs-8'>
<div class="input-group input-group-sm custom">
<input value="<?php echo $item_arr['custom11'] ?>" placeholder="<?php echo $this->lang->line('custom11_helper') ?>" list="custom11" class="form-control input-sm" name="custom11" id="custom11">
<span class="input-group-addon input-sm">Hours</span>
</div>
</div>
</div>

<div class="form-group form-group-sm custom12">
<?php echo form_label($this->config->item('custom12_name'), 'custom12', array('class' => 'control-label col-xs-3')); ?>
<div class='col-xs-8'>
<div class="input-group input-group-sm custom">
<input value="<?php echo $item_arr['custom12'] ?>" placeholder="<?php echo $this->lang->line('custom12_helper') ?>" list="custom12" class="form-control input-sm" name="custom12" id="custom12" type="number" step="1">
</div>
</div>
</div>

<?php
for ($i = 13; $i <= 20; ++$i) { //Loop through all 20 custom items in the DB
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

		let category = $('#category option:selected').text();
		let isComputer = COMPUTER_CATEGORIES.indexOf(category) !== -1;
		let isStocked = NON_STOCKED_CATEGORIES.indexOf(category) === -1;

		if (isComputer) {
			$('#computer-fields').removeClass('hidden');
			$('#tax').addClass('hidden');
		} else {
			$('#computer-fields').addClass('hidden');
			$('#tax').removeClass('hidden');
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

	var itemCat = '<?php echo $item_arr['category']; ?>';
	var itemOS = '<?php echo $item_arr['custom7']; ?>';

	if (!(itemCat === '')) { // if a cat is defined then its an existing item being edited, so set our select boxes
		$('#category').val(itemCat);
		$('#custom7').val(itemOS);
	}

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
	$(document).on('change','#category',function(){
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
	var c2 = $('[name="custom2"]').val();
	var c3 = $('[name="custom3"]').val();
	var c4 = $('[name="custom4"]').val();
	var c5 = $('[name="custom5"]').val();
	var c6 = $('[name="custom6"]').val();
	var c7 = $('[name="custom7"]').val();
	var c8 = $('[name="custom8"]').val();
	var c9 = $('[name="custom9"]').val();
	var c10 = $('[name="custom10"]').val();
	var c11 = $('[name="custom11"]').val();
	var c13 = $('[name="custom13"]').val();

	// Add on the extentions only if notnull - important for the next step
	if(c10){c10 = 'Type: ' + c10;}
	if(c4){c4 += ' Ghz';} //Add in Ghz on the CPU Speed field
	if(c5){c5 += ' GB RAM';} // Add in GB RAM to the RAM field
	if(c6){c6 += ' GB HDD';} // Add in GB HDD to the Storage field
	if(c8){c8 += ' Inch Screen';}  //  Add in Inches to the Screen field
	if(c11){c11 += ' Hours';}  //  Add in Hours to Battery field

	// Contact all fields together if they are not null
	return $.grep([c10, c2, c3, c4, c5, c6, c7, c8, c9, c11, c13], Boolean).join(", "); // skip c10 as its included in cat string

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
					table_support.handle_submit('<?php echo site_url('items'); ?>', response, stay_open);

//					  if(response.success) {

//						var answer = confirm("Do you want to reset the form?")
//						if (answer) {
							dialog_support.hide();
//						}
//					};

				},
				dataType: 'json'
			});
		},

		rules:
		{
			name: "required",
			category: "required",
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