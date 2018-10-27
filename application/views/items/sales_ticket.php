<?php $this->load->view("partial/header");

// generate our numbers for use

function formatPrice($value, $ncp = false)
{ // ncp is a bool for non concession price

    if (!$ncp) {
        return number_format((float) $value, 2, '.', ''); // round to two dec
    } else {
        return number_format((float) round(($value * 1.5) / 5) * 5, 2, '.', ''); // if ncp bool is set to true then multiply by 150% and round to nearest 5 i.e 23.50 becomes 25.00
    }

}

foreach ($cbv_info as $computer) {

  $itemCat = $computer->category;

   if (!($itemCat === 'Desktop')) {
      die('ID Provided was not a desktop type (Category is "' . $itemCat .  '")');
  }

    $boxDiscount = $computer->unit_price - $computer->custom12; // calculate the difference between full and box only

    // create an array to be used below
    $concPriceFull = "$" . formatPrice($computer->unit_price);
    $nonConcPriceFull = "$" . formatPrice($computer->unit_price, true); // + 50% for non Concession
    $concPriceBox = "$" . formatPrice($computer->custom12);
    $nonConcPriceBox = "$" . formatPrice(formatPrice($computer->unit_price, true) - $boxDiscount); // this formula is ((unit_price * 50%)-$boxDiscount)
    $specID = $computer->name . ' - ' . $computer->custom2;
    $specCPU = $computer->custom3 . ' ' . $computer->custom4 . " Ghz";
    $specRAM = $computer->custom5 . " GB";
    $specHDD = $computer->custom6 . " GB";
    $specEX = $computer->custom13;
    $specOS = $computer->custom7;

}
?>

<style>
.wrapper {
  font-size: 16px;
}
    @media print {
        @page {
            size: landscape
        }
        .container {
     width:90% !important;
}
div#content {
    margin-top: 70px;
}
    }

@page{
margin-left: 0px;
margin-right: 0px;
margin-top: 0px;
margin-bottom: 0px;
}
</style>

<script type="text/javascript">
    function printdoc() {
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
					<button type="button" onclick="printdoc();" class="btn btn-primary">Print Sales Ticket</button>
			</div>
		</div>
	</div>
</div>

<div id="title_bar" class="btn-toolbar print_hide">

<button data-toggle="modal" data-target="#printWarning" class="btn btn-info btn-sm pull-right">
    <span class="glyphicon glyphicon-print">&nbsp</span>Print Ticket
</button>

<button class='btn btn-info btn-sm pull-right' onclick="window.location.href='/items/'">
    <span class="glyphicon glyphicon-tag">&nbsp</span>Back to Items
</button>
</div>


    <div class="row" id="content">
        <div class="col-sm-6">

	  <center><img src="images/logo-cbv.png" width="420px" /></center>

<br />

        <p class="summary">This computer includes a range of free software, a keyboard, mouse and monitor. All computers sold in store come with a 3 month back to base warranty.</p>

<table class="table table-sm table-bordered table-striped">
  <thead>
    <tr>
      <th>Price</th>
      <th>Concession</th>
      <th>Full</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><b class="pricing">Full System</b></td> <!-- round up or down to nearest $5 -->
      <td><b class="pricing"><?php echo $concPriceFull ?></b></td>
      <td><?php echo $nonConcPriceFull ?></td></b></td><!-- the php below adds 25% and rounds up/down to nearest $5 -->
    </tr>
    <tr>
      <td><b class="pricing">Box Only</b></td>
      <td><b class="pricing"><?php echo $concPriceBox ?></b></td>
      <td><?php echo $nonConcPriceBox ?></b></td>
    </tr>
  </tbody>
</table>

<p class="discount-info">Box Only applies if you wish to purchase the desktop only - you will need to supply your own monitor, keyboard and mouse.</p>

<table class="table table-sm table-bordered table-striped">
  <thead>
    <tr>
      <th>Spec</th>
      <th>Details</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><img src="images/ticket-icons/cbvid.png" class="ticket-icon" /> <b>CBV ID</b></td>
      <td><?php echo $specID; ?></td>
    </tr>
    <tr>
      <td><img src="images/ticket-icons/processor.png" class="ticket-icon" /> <b>Processor</b></td>
      <td><?php echo $specCPU; ?></td>
    </tr>
    <tr>
      <td><img src="images/ticket-icons/memory.png" class="ticket-icon" /> <b>Memory</b></td>
      <td><?php echo $specRAM; ?></td>
    </tr>
    <tr>
      <td><img src="images/ticket-icons/storage.png" class="ticket-icon" /> <b>Storage</b></td>
      <td><?php echo $specHDD; ?></td>
    </tr>
    <tr>
      <td><img src="images/ticket-icons/extras.png" class="ticket-icon" /> <b>Extras</b></td>
      <td><?php echo $specEX ? $specEX : "None"; ?></td>
    </tr>
      <td><img src="images/ticket-icons/tux.png" class="ticket-icon" /> <b>OS</b></td>
      <td><?php echo $specOS ?></td>
    </tr>
  </tbody>
</table>

</div>
        <div class="col-sm-6">

	   <img src="images/linux.jpg" width="240px" />
	  <h3>What is Linux?</h3>
        <p>Our computers <b>do not</b> come with Microsoft Windows. We run Linux instead. Linux is similar to other systems you may have used before, such as Windows or OS X.</p>
		<p>Our operating system includes a built in firewall and does not require any aditional antivirus software.
		</p>

	  <h3>What Software is included?</h3>
        <p>Every Computerbank computer comes bundled with a range of useful software including Chrome and Firefox, the OpenOffice office suite, a range of games and other useful tools. Ask us for a full list for more information.</p>

	  <h3>Warranty Information</h3>
		Our restored computers come with a <b>three months</b> back to base warranty. For desktops, we extend the warranty to <b>six months</b> if the original operating system, Linux, is still installed on the computer. If you have a problem you can organise an appointment to bring it back in.
		<br />

</div>
    </div>

<?php $this->load->view("partial/footer");?>