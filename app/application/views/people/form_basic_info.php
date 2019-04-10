<?php
// if state or country are blank then set default values
$person_info->state = ($person_info->state == null ? 'Victoria' : $person_info->state);
$person_info->country = ($person_info->country == null ? 'Australia' : $person_info->country);

?>

<div class="form-group form-group-sm">
	<?php echo form_label(($this->uri->segment(1) == "employees" ? $this->lang->line('common_employee_name') : $this->lang->line('common_first_name')), 'first_name', array('class' => 'required control-label col-xs-3')); //if employees page then show 'display name'  ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
    'name' => 'first_name',
    'id' => 'first_name',
    'class' => 'form-control input-sm',
    'value' => $person_info->first_name)
); ?>
	</div>
</div>

<div class="form-group form-group-sm" <?php echo ($this->uri->segment(1) == "employees" ? 'style="display:none;"' : '') // hide from employee form  ?>>
	<?php	echo form_label($this->lang->line('common_last_name'), 'last_name', array('class' => ($this->uri->segment(1) == "employees" ? '' : 'required ') . 'control-label col-xs-3')); //if employees page then last name is optional  ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
    'name' => 'last_name',
    'id' => 'last_name',
    'class' => 'form-control input-sm',
    'value' => $person_info->last_name) // common_employee_name
); ?>
	</div>
</div>


				<div class="form-group form-group-sm" <?php echo ($this->uri->segment(1) == "employees" ? 'style="display:none;"' : '') // hide from employee form  ?>>
					<?php echo form_label($this->lang->line('customers_company_name'), 'company_name', array('class' => 'control-label col-xs-3')); ?>
					<div class='col-xs-8'>
						<?php echo form_input(array(
    'name' => 'company_name',
    'id' => 'company_name',
    'class' => 'form-control input-sm',
    'value' => $person_info->company_name)
); ?>
					</div>

				</div>



<div class="form-group form-group-sm">
	<?php echo form_label($this->lang->line('common_email'), 'email', array('class' => 'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<div class="input-group">
			<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-envelope"></span></span>
			<?php echo form_input(array(
    'name' => 'email',
    'id' => 'email',
    'class' => 'form-control input-sm',
    'value' => $person_info->email)
); ?>
		</div>
	</div>
</div>

<div class="form-group form-group-sm">
	<?php echo form_label($this->lang->line('common_phone_number'), 'phone_number', array('class' => 'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<div class="input-group">
			<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-phone-alt"></span></span>
			<?php echo form_input(array(
    'name' => 'phone_number',
    'id' => 'phone_number',
    'class' => 'form-control input-sm',
    'value' => $person_info->phone_number)
); ?>
		</div>
	</div>
</div>

<div class="form-group form-group-sm">
	<?php echo form_label($this->lang->line('common_address_1'), 'address_1', array('class' => 'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
    'name' => 'address_1',
    'id' => 'address_1',
    'class' => 'form-control input-sm',
    'value' => $person_info->address_1)
); ?>
	</div>
</div>

<div class="form-group form-group-sm">
	<?php echo form_label($this->lang->line('common_city'), 'city', array('class' => 'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
    'name' => 'city',
    'id' => 'city',
    'class' => 'form-control input-sm',
    'value' => $person_info->city)
); ?>
	</div>
</div>

<div class="form-group form-group-sm">
	<?php echo form_label($this->lang->line('common_state'), 'state', array('class' => 'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
    'name' => 'state',
    'id' => 'state',
    'class' => 'form-control input-sm',
    'value' => $person_info->state)
); ?>
	</div>
</div>

<div class="form-group form-group-sm">
	<?php echo form_label($this->lang->line('common_zip'), 'zip', array('class' => 'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
    'name' => 'zip',
    'id' => 'postcode',
    'class' => 'form-control input-sm',
    'value' => $person_info->zip)
); ?>
	</div>
</div>

<div class="form-group form-group-sm">
	<?php echo form_label($this->lang->line('common_country'), 'country', array('class' => 'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
    'name' => 'country',
    'id' => 'country',
    'class' => 'form-control input-sm',
    'value' => $person_info->country)
); ?>
	</div>
</div>

<div class="form-group form-group-sm">
	<?php echo form_label($this->lang->line('common_comments'), 'comments', array('class' => 'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_textarea(array(
    'name' => 'comments',
    'id' => 'comments',
    'class' => 'form-control input-sm',
    'value' => $person_info->comments)
); ?>
	</div>
</div>

<script type="text/javascript">
//validation and submit handling
$(document).ready(function()
{
	nominatim.init({
		fields : {
			postcode : {
				dependencies :  ["postcode", "city", "state", "country"],
				response : {
					field : 'postalcode',
					format: ["postcode", "village|town|hamlet|city_district|city", "state", "country"]
				}
			},

			city : {
				dependencies :  ["postcode", "city", "state", "country"],
				response : {
					format: ["postcode", "village|town|hamlet|city_district|city", "state", "country"]
				}
			},

			state : {
				dependencies :  ["state", "country"]
			},

			country : {
				dependencies :  ["state", "country"]
			}
		},
		language : '<?php echo current_language_code(); ?>',
		country_codes: '<?php echo $this->config->item('country_codes'); ?>'
	});
});
</script>
