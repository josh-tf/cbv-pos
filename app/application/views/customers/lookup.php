<?php $this->load->view("partial/header");?>

<?php

$concID = $this->input->post('conc_id_check');

if ($concID == "") {
    die('Invalid concession ID provided');
}

?>

<div id="title_bar" class="btn-toolbar print_hide">
<button class='btn btn-info btn-sm pull-right' onclick="window.location.href='/customers/'">
    <span class="glyphicon glyphicon-user">&nbsp</span>Back to Customers
</button>
</div>

<h4>Lookup for Concession ID [<b><?php echo $concID ?></b>]</h4>
<p>There is <?php echo count($cus_info); ?> match for this concession ID in the customer database.</p>

    <table class="table table-sm table-bordered table-striped">
<thead>
    <tr>
    <th>Person ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Address</th>
    <th>Comments</th>
    </tr>
  </thead>
  <tbody>

<?php

foreach ($cus_info as $customer) {
    ?>

    <tr>
      <td><?php echo $customer->person_id; ?></td>
      <td><?php echo $customer->first_name; ?></td>
      <td><?php echo $customer->last_name; ?></td>
      <td><?php echo $customer->email; ?></td>
      <td><?php echo $customer->address_1 . ' ' . $customer->address_2 . ' ' . $customer->city; ?></td>
      <td style="font-weight:bold;color:#F33;font-size: 1.2em;"><?php echo $customer->comments; ?></td>
    </tr>

<?php
}
?>
  </tbody>
</table>

<?php

$discCount = 0;
$discTotal = 0;

foreach ($cus_sales as $sale) {
    $totalSpent += $sale->unit_price;
    $discTotal += $sale->discount_amount;
}

?>

<br><br>

<h4>Sales for Concession ID [<b><?php echo $concID ?></b>]</h4>
<p>There are <?php echo count($cus_sales); ?> matches for this concession ID in the sales database.</p>

<div style="width:300px">
<table class="table table-sm table-bordered table-striped">
<thead>
<tr>
<th>Description</th>
<th>Total Amount</th>
</tr>
</thead>
<tbody>
<tr>
<td>Total Spent</td>
<td>$<?php echo number_format((float) ($totalSpent - $discTotal), 2, '.', ''); ?></td>
</tr>
<tr>
<td>Total Discount</td>
<td>$<?php echo number_format((float) ($discTotal), 2, '.', ''); ?></td>
</tr>

</tbody>
</table>

</div>

<table class="table table-sm table-bordered table-striped">
<thead>
    <tr>
    <th>ID</th>
    <th>Sale Date</th>
    <th>Item Name</th>
    <th>Price</th>
    <th>Discount</th>
    <th>Paid</th>
    <th>Description</th>
    </tr>
  </thead>
  <tbody>

<?php

foreach ($cus_sales as $sale) {
    ?>

    <tr>
      <td><?php echo $sale->person_id; ?> (<?php echo $sale->first_name; ?>)</td>
      <td><?php echo $sale->sale_time; ?></td>
      <td><?php echo $sale->name; ?> (<?php echo $sale->category; ?>)</td>
      <td>$<?php echo number_format((float) ($sale->unit_price), 2, '.', ''); ?></td>
      <td>$<?php echo number_format((float) ($sale->discount_amount), 2, '.', ''); ?></td>
      <td>$<?php echo number_format((float) ($sale->unit_price - $sale->discount_amount), 2, '.', ''); ?></td>
      <td><?php echo $sale->description; ?></td>
    </tr>

<?php
}
?>

  </tbody>
</table>

<?php $this->load->view("partial/footer");?>
