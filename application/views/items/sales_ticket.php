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

      print('<span class="ticketCatErr"><b>An error has occurred..</b><br><br> Sales ticket is only available for the "Desktop" item type. <br>The category for the selected item was <i>"' . $itemCat .  '"</><br>');
      print('<br><b><a href="../items">Back to Items</a></b></span>');
      die();

  }

    // create an array to be used below
    $concPriceFull = "$" . formatPrice($computer->unit_price);
    $nonConcPriceFull = "$" . formatPrice($computer->unit_price, true); // item price x1.5 for non Concession
    $concPriceBox = "$" . formatPrice($computer->custom12);
    $nonConcPriceBox = "$" . formatPrice($computer->custom12, true); // box only x1.5 for non Concession
    $specID = $computer->name;
    $specModel = $computer->custom2;
    $specCPU = $computer->custom3 . " " . $computer->custom4 . " Ghz";
    $specRAM = $computer->custom5 . " GB";
    $specHDD = $computer->custom6 . " GB";
    $specMonitor = $computer->custom8 . " inches";
    $specEX = $computer->custom13;

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
      width: 90% !important;
    }

    div#content {
      margin-top: 70px;
    }
  }

  @page {
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
            <tr>
              <th scope="row">Headers/Footers</th>
              <td colspan="2">Off</td>
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

    <div style="height:77px">
      <img src="images/ticket-logo.png" width="252px" style="float:left;" />
      <div class="ticket-cbvid"><b>ID:</b>
        <?php echo $specID ?>
      </div>
    </div>

    <br />

    <p class="summary">This computer includes a range of free software, a keyboard, mouse and monitor. All computers
      sold in store come with a 3 month back to base warranty.</p>

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
          <td><b class="pricing">Full System</b></td>
          <td><b class="pricing">
              <?php echo $concPriceFull ?></b></td>
          <td>
            <?php echo $nonConcPriceFull ?>
          </td></b></td>
        </tr>
        <tr>
          <td><b class="pricing">Box Only</b></td>
          <td><b class="pricing">
              <?php echo $concPriceBox ?></b></td>
          <td>
            <?php echo $nonConcPriceBox ?></b></td>
        </tr>
      </tbody>
    </table>

    <p class="discount-info">The Box Only price applies if you wish to purchase the desktop only, you will need to
      supply your own monitor, keyboard and mouse.</p>

    <table class="table table-sm table-bordered table-striped ticket-specs">
      <thead>
        <tr>
          <th>Spec</th>
          <th>Details</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><img src="images/ticket-icons/cbvid.png" class="ticket-icon" /> <b>Model</b></td>
          <td>
            <?php echo $specModel; ?>
          </td>
        </tr>
        <tr>
          <td><img src="images/ticket-icons/processor.png" class="ticket-icon" /> <b>Processor</b></td>
          <td>
            <?php echo $specCPU; ?>
          </td>
        </tr>
        <tr>
          <td><img src="images/ticket-icons/memory.png" class="ticket-icon" /> <b>Memory</b></td>
          <td>
            <?php echo $specRAM; ?>
          </td>
        </tr>
        <tr>
          <td><img src="images/ticket-icons/storage.png" class="ticket-icon" /> <b>Storage</b></td>
          <td>
            <?php echo $specHDD; ?>
          </td>
        </tr>
        </tr>
        <td><img src="images/ticket-icons/monitor.png" class="ticket-icon" /> <b>Monitor</b></td>
        <td>
          <?php echo $specMonitor ?>
        </td>
        </tr>
        <tr>
          <td><img src="images/ticket-icons/extras.png" class="ticket-icon" /> <b>Extras</b></td>
          <td>
            <?php echo $specEX ? $specEX : "None"; ?>
          </td>
      </tbody>
    </table>

  </div>
  <div class="col-sm-6">

    <img src="images/ticket-linux.png" width="570px" />

    <h3>What is Linux?</h3>
    <p>Our computers <b>do not</b> come with Microsoft Windows. We run Linux instead. Linux is similar to other systems
      you may have used before, such as Windows or OS X.</p>
    <p>Our operating system includes a built in firewall and does not require any additional antivirus software.
    </p>

    <h3>What Software is included?</h3>
    <p>Every Computerbank computer comes bundled with a range of useful software including Chrome and Firefox, the
      OpenOffice office suite and a range of games and other useful tools.</p>
    <p>Please ask us if you have any questions about the included or available software.</p>

    <h3>Warranty Information</h3>
    Our restored computers come with a <b>three months</b> back to base warranty.</p>
    <p>For desktops, we extend the warranty to <b>six months</b> if the original operating system, Linux, is still
      installed on the computer.</p>
    <p>If you have a problem you can organise an appointment to bring it back in.</p>
    <br />

  </div>
</div>

<?php $this->load->view("partial/footer");?>