<?php
echo form_open(base_url('items/sales_ticket'), array('id' => 'redir', 'class' => 'redir'));

// intermediary script to handle the post reqeust
$cbv_id = $this->input->get('id', true);
echo '<input type="hidden" name="cbv_id" value="' . htmlentities($cbv_id) . '">';

echo form_close();
?>

<script type="text/javascript">
    document.getElementById('redir').submit();
</script>