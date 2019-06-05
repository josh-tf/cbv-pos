<?php $this->load->view("partial/header"); ?>

<script type="text/javascript">
	dialog_support.init("a.modal-dlg");
</script>

<center><img src="./images/banner.png" style="text-align: center;width: 60%;"></center>
<h3 class="text-center"><?php echo $this->lang->line('common_welcome_message_start') . ' <b>' . $this->lang->line('common_welcome_message_mid') . '</b> - ' , $this->lang->line('common_welcome_message_end') ?></h3>

<div id="home_module_list">
	<?php
    foreach ($allowed_modules as $module) {
        ?>
		<div class="module_item" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang->line('module_'.$module->module_id.'_desc'); ?>">
			<a href="<?php echo site_url("$module->module_id"); ?>"><img src="<?php echo base_url().'images/menubar/blue/'.$module->module_id.'.png'; ?>" border="0" alt="Menubar Image" /></a>
			<a href="<?php echo site_url("$module->module_id"); ?>"><?php echo $this->lang->line("module_".$module->module_id) ?></a>
		</div>
	<?php
    }
    ?>
</div>

<?php $this->load->view("partial/footer"); ?>
