<?php
echo form_open(base_url('customers/lookup/'), array('id' => 'redir', 'class' => 'redir'));

// intermediary script to handle the post reqeust
$conc_id_check = $this->input->get('id', true);
echo '<input type="hidden" name="conc_id_check" value="' . htmlentities($conc_id_check) . '">';

echo form_close();
?>

<script type="text/javascript">
    document.getElementById('redir').submit();
</script>