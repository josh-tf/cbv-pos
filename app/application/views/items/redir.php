<?php
echo form_open(base_url('items/sales_ticket'), array('id' => 'redir', 'class' => 'redir'));

// intermediary script to handle the post reqeust
$cbvid_check = $this->input->get('id', true);
echo '<input type="hidden" name="cbvid_check" value="' . htmlentities($cbvid_check) . '">';

echo form_close();
?>

<script type="text/javascript">
    document.getElementById('redir').submit();
</script>