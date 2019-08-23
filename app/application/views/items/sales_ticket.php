<?php $this->load->view('partial/header');?>

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
<div class="modal bootstrap-dialog modal-dlg type-primary fade size-normal in" id="printWarning" tabindex="-1" role="dialog" aria-labelledby="printWarningLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="bootstrap-dialog-header">
                    <div class="bootstrap-dialog-close-button" style="display: block;">
                        <button class="close" aria-label="close">×</button>
                    </div>
                    <div class="bootstrap-dialog-title">Printer Settings</div>
                </div>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading"><b>Important Notice</b></h4>
                    <p style="font-size: 13px;">To ensure the sales ticket is printed correctly, please ensure the printer settings in the popup dialog are configured as follows:</p>
                </div>
                <br>
                <table style="font-size: 13px;" class="table table-bordered">
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
<?php
if (count($cbvid_check) > 0) {
    ?>
  <button data-toggle="modal" data-target="#printWarning" class="btn btn-info btn-sm pull-right">
    <span class="glyphicon glyphicon-print">&nbsp</span>Print Ticket
  </button>
  <?php
}
?>
  <button class='btn btn-info btn-sm pull-right' onclick="window.location.href='/items/'">
    <span class="glyphicon glyphicon-tag">&nbsp</span>Back to Items
  </button>
</div>

<?php

// die if no matches
if (count($cbvid_check) == 0) {
    ?>

<div class="alert alert-danger" role="alert">
  <b>Error occurred:</b> No matching computer ID was found in the database.
</div>

<?php
die();
}

// generate our numbers for use
function formatPrice($value, $ncp = false)
{ // ncp is a bool for non concession price

    if (!$ncp) {
        return number_format((float) $value, 2, '.', ''); // round to two dec
    } else {
        return number_format((float) round(($value * 1.5) / 5) * 5, 2, '.', ''); // if ncp bool is set to true then multiply by 150% and round to nearest 5 i.e 23.50 becomes 25.00
    }
}

foreach ($cbvid_check as $computer) {
    $itemCat = $computer->category;

    if (!($itemCat === 'Desktop' || $itemCat === 'Laptop')) {
        ?>

<div class="alert alert-danger" role="alert">
  <b>Error occurred:</b> Sales ticket is only available for the <i>Desktop/Laptop</i> item type however the category for the selected item was <i><?php echo $itemCat ?></i>
     </div>

<?php
die();
    }

    // create an array to be used below
    $concPriceFull = '$' . formatPrice($computer->unit_price);

    if ($itemCat === 'Desktop') {
        $nonConcPriceFull = '$' . formatPrice($computer->unit_price, true); // item price x1.5 for non Concession
        $concPriceBox = '$' . formatPrice($computer->custom12);
        $nonConcPriceBox = '$' . formatPrice($computer->custom12, true); // box only x1.5 for non Concession
    }

    $specID = $computer->name;
    $specModel = $computer->custom2;
    $specCPU = $computer->custom3 . ' ' . $computer->custom4 . ' Ghz';
    $specRAM = $computer->custom5 . ' GB';
    $specHDD = $computer->custom6;
    $specMonitor = $computer->custom8 . ' inches';
    $specEX = $computer->custom13;
    $specBatt = $computer->custom11 . ' hrs';
}
?>

<div class="row" id="content">
  <div class="col-sm-6">

    <div style="height:77px">
      <img src="images/ticket-logo.png" width="252px" style="float:left;" />
      <div class="ticket-cbvid"><b>ID:</b>
        <?php echo $specID ?>
      </div>
    </div>

    <br />

<?php

switch ($itemCat) {

    case 'Desktop':
        $itemIncludes = 'user guide, a keyboard, mouse and monitor.';
        break;
    case 'Laptop':
        $itemIncludes = 'user guide, power adaptor and laptop care guide.';
}

?>

    <p class="summary">This computer includes a range of free software, <?php echo $itemIncludes; ?> All computers
      sold in store come with a 3 month back to base warranty.</p>

    <table class="table table-sm table-bordered table-striped">
      <thead>
        <tr>
          <th>Price</th>
          <th <?php if ($itemCat === 'Laptop') {
    echo 'colspan="2"';
}?>>Concession</th>
        <?php if ($itemCat === 'Desktop') {
    ?> <th>Full</th> <?php
}?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><b class="pricing">Full System</b></td>
          <td <?php if ($itemCat === 'Laptop') {
        echo 'colspan="2"';
    }?>><b class="pricing">
              <?php echo $concPriceFull ?></b></td>
              <?php if ($itemCat === 'Desktop') {
        ?><td>
            <?php echo $nonConcPriceFull ?>
          </td></b><?php
    }?>
        </tr>
<?php
if ($itemCat == 'Desktop') {
        ?>
        <tr>
          <td><b class="pricing">Box Only</b></td>
          <td><b class="pricing">
              <?php echo $concPriceBox ?></b></td>
          <td>
            <?php echo $nonConcPriceBox ?></b></td>
        </tr>
        <?php
    }
?>
      </tbody>
    </table>

    <?php
if ($itemCat == 'Desktop') {
    ?>
    <p class="discount-info">The Box Only price applies if you wish to purchase the desktop only, you will need to
      supply your own monitor, keyboard and mouse.</p>
      <?php
} else {
        ?>
        <p class="discount-info">Some models also include a carry bag, please ask us if this laptop includes one.</p>
      <?php
    }
?>

    <table class="table table-sm table-bordered table-striped ticket-specs">
      <thead>
        <tr>
          <th>Spec</th>
          <th>Details</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td width="30%"><img src="images/ticket-icons/cbvid.png" class="ticket-icon" /> <b>Model</b></td>
          <td width="70%">
            <?php echo $specModel; ?>
          </td>
        </tr>
        <tr>
          <td width="30%"><img src="images/ticket-icons/processor.png" class="ticket-icon" /> <b>Processor</b></td>
          <td width="70%">
            <?php echo $specCPU; ?>
          </td>
        </tr>
        <tr>
          <td width="30%"><img src="images/ticket-icons/memory.png" class="ticket-icon" /> <b>Memory</b></td>
          <td width="70%">
            <?php echo $specRAM; ?>
          </td>
        </tr>
        <tr>
          <td width="30%"><img src="images/ticket-icons/storage.png" class="ticket-icon" /> <b>Storage</b></td>
          <td width="70%">
            <?php echo $specHDD; ?>
          </td>
        </tr>
        </tr>
        <td width="30%"><img src="images/ticket-icons/monitor.png" class="ticket-icon" /> <b>Monitor</b></td>
        <td width="70%">
          <?php echo $specMonitor ?>
        </td>
        </tr>
        <?php
if ($itemCat == 'Laptop') {
    ?>

<tr>
          <td width="30%"><img src="images/ticket-icons/extras.png" class="ticket-icon" /> <b>Battery</b></td>
          <td width="70%">
            <?php echo $specBatt; ?>
          </td>
        </tr>

<?php
}
?>
        <tr>
          <td><img src="images/ticket-icons/extras.png" class="ticket-icon" /> <b>Extras</b></td>
          <td width="70%">
            <?php echo $specEX ? $specEX : 'None'; ?>
          </td>
        </tr>
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

<?php $this->load->view('partial/footer');?>