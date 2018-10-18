<?php
// grab our ID from the url
$cbvid = htmlspecialchars($_GET['id']);

// exit if the id is empty
if (empty($cbvid)) {
    die('Invalid ID Provided');
}

// using docker env vars
$servername = getenv('MYSQL_HOST_NAME');
$username = getenv('MYSQL_USERNAME');
$password = getenv('MYSQL_PASSWORD');
$dbname = getenv('MYSQL_DB_NAME');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Using prepared statements to prevent possible SQL injection
$stmt = $conn->prepare('SELECT * FROM cbvpos_items WHERE name = ?');
$stmt->bind_param('s', $cbvid); // 's' specifies the variable type => 'string'

$stmt->execute();

$result = $stmt->get_result();

// if no results, exit
if ($result->num_rows == 0) {
    die('Invalid ID Provided');
}

while ($row = $result->fetch_assoc()) {

    // exit if they provided something other than a desktop

    $itemCat = $row['category'];

    if (!($itemCat === 'Desktop')) {
        die('ID Provided was not a desktop type (Category is "' . $itemCat .  '")');
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

    $boxDiscount = $row['unit_price'] - $row['custom12']; // calculate the difference between full and box only

    // create an array to be used below
    $ticket['concPriceFull'] = "$" . formatPrice($row['unit_price']);
    $ticket['nonConcPriceFull'] = "$" . formatPrice($row['unit_price'], true); // + 50% for non Concession
    $ticket['concPriceBox'] = "$" . formatPrice($row['custom12']);
    $ticket['nonConcPriceBox'] = "$" . formatPrice(formatPrice($row['unit_price'], true) - $boxDiscount); // this formula is ((unit_price * 50%)-$boxDiscount)
    $ticket['specID'] = $row['name'] . ' - ' . $row['custom2'];
    $ticket['specCPU'] = $row['custom3'] . ' ' . $row['custom4'] . " Ghz";
    $ticket['specRAM'] = $row['custom5'] . " GB";
    $ticket['specHDD'] = $row['custom6'] . " GB";
    $ticket['specEX'] = implode(", ", array_filter([$row['custom8'] ? $row['custom8'] . '" Screen' : null, $row['custom9'], $row['custom13']]));
    $ticket['specOS'] = $row['custom7'];
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>CBV Sales Ticket - <?echo $cbvid; ?></title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="css/extra/normalize.css">
  <link rel="stylesheet" href="css/extra/skeleton.css">

  <style>@page { size: A4 landscape }</style>

<script type="text/javascript">
    $(window).on('load',function(){
        $('#printWarning').modal('show');
    });

    function printdoc(){
      $('#printWarning').modal('hide');
		  window.print();
    }
</script>

</head>

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

<body class="A4 landscape">

  <section class="sheet padding-10mm">
      <div class="row">
      <div class="one-half column">
	  <center><img src="images/logo-cbv.png" width="420px" /></center>
        <p class="summary">This computer includes a range of free software, a keyboard, mouse and monitor. All computers sold in store come with a 3 month back to base warranty.</p>

<table class="u-full-width">
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
      <td><b class="pricing"><?php echo $ticket['concPriceFull'] ?></b></td>
      <td><?php echo $ticket['nonConcPriceFull'] ?></td></b></td><!-- the php below adds 25% and rounds up/down to nearest $5 -->
    </tr>
    <tr>
      <td><b class="pricing">Box Only</b></td>
      <td><b class="pricing"><?php echo $ticket['concPriceBox'] ?></b></td>
      <td><?php echo $ticket['nonConcPriceBox'] ?></b></td>
    </tr>
  </tbody>
</table>

<p class="discount-info">Box Only applies if you wish to purchase the desktop only - you will need to supply your own monitor, keyboard and mouse.</p>

<table class="u-full-width">
  <thead>
    <tr>
      <th>Spec</th>
      <th>Details</th>
    </tr>
  </thead>
  <tbody>   <?php echo $ticket['']; ?>
    <tr>
      <td><img src="images/ticket-icons/cbvid.png" class="ticket-icon" /> <b>CBV ID</b></td>
      <td><?php echo $ticket['specID']; ?></td>
    </tr>
    <tr>
      <td><img src="images/ticket-icons/processor.png" class="ticket-icon" /> <b>Processor</b></td>
      <td><?php echo $ticket['specCPU']; ?></td>
    </tr>
    <tr>
      <td><img src="images/ticket-icons/memory.png" class="ticket-icon" /> <b>Memory</b></td>
      <td><?php echo $ticket['specRAM']; ?></td>
    </tr>
    <tr>
      <td><img src="images/ticket-icons/storage.png" class="ticket-icon" /> <b>Storage</b></td>
      <td><?php echo $ticket['specHDD']; ?></td>
    </tr>
    <tr>
      <td><img src="images/ticket-icons/extras.png" class="ticket-icon" /> <b>Extras</b></td>
      <td><?php echo $ticket['specEX']; ?></td>
    </tr>
      <td><img src="images/ticket-icons/tux.png" class="ticket-icon" /> <b>OS</b></td>
      <td><?php echo $ticket['specOS'] ?></td>
    </tr>
  </tbody>
</table>

	  </div>
      <div class="one-half column" class="mt5">
	   <img src="images/linux.jpg" width="240px" />
	  <h5>What is Linux?</h5>
        <p>Our computers <b>do not</b> come with Microsoft Windows. We run Linux instead. Linux is similar to other systems you may have used before, such as Windows or OS X.</p>
		<p>Our operating system includes a built in firewall and does not require any aditional antivirus software.
		</p>

	  <h5>What Software is included?</h5>
        <p>Every Computerbank computer comes bundled with a range of useful software including Chrome and Firefox, the OpenOffice office suite, a range of games and other useful tools. Ask us for a full list for more information.</p>

	  <h5>Warranty Information</h5>
		Our restored computers come with a <b>three months</b> back to base warranty. For desktops, we extend the warranty to <b>six months</b> if the original operating system, Linux, is still installed on the computer. If you have a problem you can organise an appointment to bring it back in.
		<br />

      </div>
    </div>

  </section>

</body>

</html>

<?php
}
?>
