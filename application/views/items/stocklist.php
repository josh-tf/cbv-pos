<?php $this->load->view("partial/header");?>

<style>
@media print{@page {size: landscape}}
</style>

     <?php foreach($stocklist as $computer){?>
     <tr>
         <td><?php echo $post->name;?></td>
         <td><?php echo $post->unit_price;?></td>
      </tr>
     <?php }?>


<script type="text/javascript">

</script>

<div id="title_bar" class="btn-toolbar print_hide">

    <button class='btn btn-info btn-sm pull-right' onclick="window.open('./stock-list-print.php')">
        <span class="glyphicon glyphicon-print">&nbsp</span>Print Stocklist
    </button>

    <button class='btn btn-info btn-sm pull-right' onclick="window.open('./stock-list.php')">
        <span class="glyphicon glyphicon-file">&nbsp</span>View Stocklist
    </button>
</div>

 <div class="container">
    <div class="row">

<h3>Desktops</h3>
<p>The listed concession price is only available to concession card holders. Please have a valid concession card ready when you make your purchase. You may purchase a desktop computer without a concession card, but you will be charged our market price, as shown below.</p>


<table class="table table-sm table-bordered">
<thead>
    <tr>
    <th>ID</th>
    <th>Type</th>
    <th>Conc. Price</th>
    <th>Retail Price</th>
    <th>Model</th>
    <th>CPU Type</th>
    <th>CPU Speed</th>
    <th>RAM</th>
    <th>HDD</th>
    <th>Screen Size</th>
    <th>DVD Drive</th>
    <th>Notes</th>
    <th>System</th>
    </tr>
  </thead>
  <tbody>

<?php
foreach($stocklist as $computer){

if(($computer->category) == "Desktop"){

    ?>
    <?php echo $computer->name;?>
    <tr>
      <td><?php echo $computer->name; ?></td>
      <td><?php echo ($computer->custom10) ? $computer->custom10 : 'Tower'; // type  ?></td>
      <td>$<?php echo number_format((float) ($computer->unit_price), 2, '.', ''); ?></td>
      <td>$<?php echo number_format((float) ($computer->unit_price) * 1.5, 2, '.', ''); ?></td>
      <td><?php echo $computer->custom2; //brand/model   ?></td>
      <td><?php echo $computer->custom3; // cpu type  ?></td>
      <td><?php echo $computer->custom4; // cpu speed  ?> Ghz</td>
      <td><?php echo $computer->custom5; // ram  ?> GB</td>
      <td><?php echo $computer->custom6; // hdd  ?> GB</td>
      <td><?php echo $computer->custom8; // screen  ?>in</td>
      <td><?php echo ($computer->custom9) ? $computer->custom9 : 'None'; // optical drive  ?></td>
      <td><?php echo ($computer->custom13) ? $computer->custom13 : 'None'; // extras  ?></td>
      <td><?php echo $computer->custom7; // operating system  ?></td>
    </tr>

<?php
}
}
?>
  </tbody>
</table>

<br><br>

<h3>Laptops</h3>
<p>Laptops are first come, first served. You must have a valid concession card to purchase a laptop. Strictly one laptop per customer.

</p>

<table class="table table-sm table-bordered">

  <thead>
    <tr>
    <th>ID</th>
    <th>Conc. Price</th>
    <th>Model</th>
    <th>CPU Type</th>
    <th>CPU Speed</th>
    <th>RAM</th>
    <th>HDD</th>
    <th>Screen Size</th>
    <th>DVD Drive</th>
    <th>Battery Life</th>
    <th>Notes</th>
    <th>System</th>
    </tr>
  </thead>
  <tbody>

<?php
foreach($stocklist as $computer){

if(($computer->category) == "Laptop"){
?>

    <tr>
      <td><?php echo $computer->name; ?></td>
      <td>$<?php echo number_format((float) ($computer->unit_price), 2, '.', ''); ?></td>
      <td><?php echo $computer->custom2; //brand/model   ?></td>
      <td><?php echo $computer->custom3; // cpu type  ?></td>
      <td><?php echo $computer->custom4; // cpu speed  ?> Ghz</td>
      <td><?php echo $computer->custom5; // ram  ?> GB</td>
      <td><?php echo $computer->custom6; // hdd  ?> GB</td>
      <td><?php echo $computer->custom8; // screen  ?>in</td>
      <td><?php echo ($computer->custom9) ? $computer->custom9 : 'None'; // optical drive  ?></td>
      <td><?php echo $computer->custom11; // battery life  ?> hrs</td>
      <td><?php echo ($computer->custom13) ? $computer->custom13 : 'None'; // extras  ?></td>
      <td><?php echo $computer->custom7; // operating system  ?></td>
    </tr>

    <?php
}
}
?>

  </tbody>
</table>

<br><br>

      </div>
  </div>

<?php $this->load->view("partial/footer");?>
