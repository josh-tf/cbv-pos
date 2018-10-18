<?php echo form_open('config/save_cbvconf/', array('id' => 'cbvconf_config_form', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal')); ?>

	<div id="config_wrapper">
		<fieldset id="config_info">
			<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>
			<ul id="cbvconf_error_message_box" class="error_message_box"></ul>

<h5>General Config</h5>

	<div class="form-group form-group-sm">
		<?php echo form_label($this->lang->line('cbvopt_distuser'), 'cbvopt_distuser', array('class' => 'control-label col-xs-2')); ?>
			<div class='col-xs-2'>
				<?php echo form_input(array(
					'name' => 'cbvopt_distuser',
					'id' => 'cbvopt_distuser',
					'class' => 'form-control input-sm',
					'value' => $this->config->item('cbvopt_distuser'))); ?>
			</div>
	</div>

	<div class="form-group form-group-sm">
		<?php echo form_label($this->lang->line('cbvopt_distpass'), 'cbvopt_distpass', array('class' => 'control-label col-xs-2')); ?>
			<div class='col-xs-2'>
				<?php echo form_input(array(
					'name' => 'cbvopt_distpass',
					'id' => 'cbvopt_distpass',
					'class' => 'form-control input-sm',
					'value' => $this->config->item('cbvopt_distpass'))); ?>
			</div>
	</div>

	<div class="form-group form-group-sm">
		<?php echo form_label($this->lang->line('cbvopt_distver'), 'cbvopt_distver', array('class' => 'control-label col-xs-2')); ?>
			<div class='col-xs-2'>
				<?php echo form_input(array(
					'name' => 'cbvopt_distver',
					'id' => 'cbvopt_distver',
					'class' => 'form-control input-sm',
					'value' => $this->config->item('cbvopt_distver'))); ?>
			</div>
	</div>

<br/>
<h5>Item Dropdowns</h5>

	<div class="form-group form-group-sm">
		<?php echo form_label($this->lang->line('cbvopt_item_cat'), 'cbvopt_item_cat', array('class' => 'control-label col-xs-2')); ?>
			<div class='col-xs-2'>
				<?php echo form_input(array(
					'name' => 'cbvopt_item_cat',
					'id' => 'cbvopt_item_cat',
					'class' => 'form-control input-sm',
					'value' => $this->config->item('cbvopt_item_cat'))); ?>
			</div>
	</div>

	<div class="form-group form-group-sm">
		<?php echo form_label($this->lang->line('cbvopt_item_cpu'), 'cbvopt_item_cpu', array('class' => 'control-label col-xs-2')); ?>
			<div class='col-xs-2'>
				<?php echo form_input(array(
					'name' => 'cbvopt_item_cpu',
					'id' => 'cbvopt_item_cpu',
					'class' => 'form-control input-sm',
					'value' => $this->config->item('cbvopt_item_cpu'))); ?>
			</div>
	</div>

	<div class="form-group form-group-sm">
		<?php echo form_label($this->lang->line('cbvopt_item_os'), 'cbvopt_item_os', array('class' => 'control-label col-xs-2')); ?>
			<div class='col-xs-2'>
				<?php echo form_input(array(
					'name' => 'cbvopt_item_os',
					'id' => 'cbvopt_item_os',
					'class' => 'form-control input-sm',
					'value' => $this->config->item('cbvopt_item_os'))); ?>
			</div>
	</div>

	<div class="form-group form-group-sm">
		<?php echo form_label($this->lang->line('cbvopt_item_ram'), 'cbvopt_item_ram', array('class' => 'control-label col-xs-2')); ?>
			<div class='col-xs-2'>
				<?php echo form_input(array(
					'name' => 'cbvopt_item_ram',
					'id' => 'cbvopt_item_ram',
					'class' => 'form-control input-sm',
					'value' => $this->config->item('cbvopt_item_ram'))); ?>
			</div>
	</div>

	<div class="form-group form-group-sm">
		<?php echo form_label($this->lang->line('cbvopt_item_storage'), 'cbvopt_item_storage', array('class' => 'control-label col-xs-2')); ?>
			<div class='col-xs-2'>
				<?php echo form_input(array(
					'name' => 'cbvopt_item_storage',
					'id' => 'cbvopt_item_storage',
					'class' => 'form-control input-sm',
					'value' => $this->config->item('cbvopt_item_storage'))); ?>
			</div>
	</div>

	<div class="form-group form-group-sm">
		<?php echo form_label($this->lang->line('cbvopt_item_screen'), 'cbvopt_item_screen', array('class' => 'control-label col-xs-2')); ?>
			<div class='col-xs-2'>
				<?php echo form_input(array(
					'name' => 'cbvopt_item_screen',
					'id' => 'cbvopt_item_screen',
					'class' => 'form-control input-sm',
					'value' => $this->config->item('cbvopt_item_screen'))); ?>
			</div>
	</div>

	<div class="form-group form-group-sm">
		<?php echo form_label($this->lang->line('cbvopt_item_optical'), 'cbvopt_item_optical', array('class' => 'control-label col-xs-2')); ?>
			<div class='col-xs-2'>
				<?php echo form_input(array(
					'name' => 'cbvopt_item_optical',
					'id' => 'cbvopt_item_optical',
					'class' => 'form-control input-sm',
					'value' => $this->config->item('cbvopt_item_optical'))); ?>
			</div>
	</div>

	<div class="form-group form-group-sm">
		<?php echo form_label($this->lang->line('cbvopt_item_type'), 'cbvopt_item_type', array('class' => 'control-label col-xs-2')); ?>
			<div class='col-xs-2'>
				<?php echo form_input(array(
					'name' => 'cbvopt_item_type',
					'id' => 'cbvopt_item_type',
					'class' => 'form-control input-sm',
					'value' => $this->config->item('cbvopt_item_type'))); ?>
			</div>
	</div>

			<?php echo form_submit(array(
				'name' => 'submit_cbvconf',
				'id' => 'submit_cbvconf',
				'value' => $this->lang->line('common_submit'),
				'class' => 'btn btn-primary btn-sm pull-right')); ?>
		</fieldset>
	</div>
<?php echo form_close(); ?>

<script type="text/javascript">
//validation and submit handling
$(document).ready(function()
{
	$('#cbvconf_config_form').validate($.extend(form_support.handler, {
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				success: function(response) {
					$.notify(response.message, { type: response.success ? 'success' : 'danger'} );
				},
				dataType: 'json'
			});
		},

		errorLabelContainer: '#cbvconf_error_message_box'
	}));
});
</script>
