<?php $this->load->view("partial/header");?>

<style>
td {
    padding: 4px !important;
}

.printed{
    font-size: 14px;
    vertical-align: middle;
}

.print-show{
  display: none;
}

img.logo {
    width: 225px;
    float: right;
    margin-bottom: 25px;
    display:none;
}

@media print{

@page {size: landscape}

table.table.table-sm.table-bordered {
    font-size: 0.9em;
}

body, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
  font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
}

.print-show{
  display: inline;
}

img.logo {
  display: inherit;
}

h3 {
    padding-top: 40px;
}
}

</style>

<script type="text/javascript">
    function printdoc(){
      $('#printWarning').modal('hide');
		  window.print();
    }
</script>


<!-- Modal -->
<div class="modal" id="printWarning" tabindex="-1" role="dialog" aria-labelledby="printWarningLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="printWarningLabel">Printer Settings</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
<h3>Important</h3>
<p>
To ensure the sales ticket is printed correctly, please ensure
the printer settings in the popup dialog are configured as follows:
</p>
<br>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Setting</th>
      <th scope="col">Option</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">2-Sided</th>
      <td>Any</td>
    </tr>
    <tr>
      <th scope="row">Orientation</th>
      <td>Landscape</td>
    </tr>
    <tr>
      <th scope="row">Scaling</th>
      <td colspan="2">100%</td>
    </tr>
  </tbody>
</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="button" onclick="printdoc();" class="btn btn-primary">Print Stocklist Ticket</button>
			</div>
		</div>
	</div>
</div>

     <?php foreach($stocklist as $computer){?>
     <tr>
         <td><?php echo $post->name;?></td>
         <td><?php echo $post->unit_price;?></td>
      </tr>
     <?php }?>

<div id="title_bar" class="btn-toolbar print_hide">

    <button data-toggle="modal" data-target="#printWarning" class="btn btn-info btn-sm pull-right">
        <span class="glyphicon glyphicon-print">&nbsp</span>Print Stocklist
    </button>

    <button class='btn btn-info btn-sm pull-right' onclick="window.location.href='/items/'">
        <span class="glyphicon glyphicon-tag">&nbsp</span>Back to Items
    </button>
</div>

 <div class="container">
    <div class="row">

<div class="desktop-stocklist">

<img src="images/cbv-logo-black.png" class="logo"/>

<h3>Desktops <span class="printed print-show">- Printed on <?php echo date('D d/m/y'); ?></span></h3>
<p class="print_hide">The listed concession price is only available to concession card holders. Please have a valid concession card ready when you make your purchase. You may purchase a desktop computer without a concession card, but you will be charged our market price, as shown below.</p>

<table class="table table-sm table-bordered table-striped">
<thead class="thead-light">
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
    <th>System</th>
    </tr>
  </thead>
  <tbody>

<?php
foreach($stocklist as $computer){

if(($computer->category) == "Desktop"){

    ?>
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
      <td><?php echo $computer->custom7; // operating system  ?></td>
    </tr>

<?php
}
}
?>
  </tbody>
</table>

</div>

<br><br>

<div class="pagebreak laptop-stocklist">

<img src="images/cbv-logo-black.png" class="logo"/>

<h3>Laptops <span class="printed print-show">- Printed on <?php echo date('D d/m/y'); ?></span></h3>
<p class="print_hide">Laptops are first come, first served. You must have a valid concession card to purchase a laptop. Strictly one laptop per customer.</p>

<table class="table table-sm table-bordered table-striped">

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
      <td><?php echo $computer->custom7; // operating system  ?></td>
    </tr>

    <?php
}
}
?>

  </tbody>
</table>

</div>

<br><br>

      </div>
  </div>

<?php $this->load->view("partial/footer");?>
