<?php
// grab our ID from the url
$cbvid = htmlspecialchars($_GET["id"]);

// exit if the id is empty
if (empty($cbvid)) {
    die("Invalid ID Provided");
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
  die("Invalid ID Provided");
}

while ($row = $result->fetch_assoc()) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>CBV Sales Ticket - <? echo $cbvid; ?></title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
  
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  
  <link rel="stylesheet" href="css/extra/normalize.css">
  <link rel="stylesheet" href="css/extra/skeleton.css">

  <style>@page { size: A4 landscape }</style>
  
</head>

<body class="A4 landscape">

  <section class="sheet padding-10mm">
      <div class="row">
      <div class="one-half column">
	  <center><img src="images/logo-cbv.png" width="420px" /></center>
        <p class="summary">This computer includes a range of free software, a keyboard, mouse and monitor. All computers sold in store come with a 3 month back to base warranty.</p>

<table class="u-full-width">
  <thead>
    <tr>
      <th>Type</th>
      <th>Price</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><b class="pricing">Concession</b></td> <!-- round up or down to nearest $5 -->
      <td><b class="pricing">$<?php echo number_format((float)round(($row["unit_price"])/5) * 5, 2, '.', ''); ?></b></td>
    </tr>
    <tr>
      <td><b class="pricing">Non Concession</b></td> <!-- the php below adds 25% and rounds up/down to nearest $5 -->
      <td><b class="pricing">$<?php echo number_format((float)round(($row["unit_price"] * 1.25)/5) * 5, 2, '.', ''); ?></b></td>
    </tr>
    <tr>
      <td><i>Without Accessories</i></td>
      <td>-$20 discount</td>
    </tr>
  </tbody>
</table>

<p class="discount-info">The discount above aplies if you wish to purchase the desktop only - you will need to supply your own monitor, keyboard and mouse.</p>

<table class="u-full-width">
  <thead>
    <tr>
      <th>Spec</th>
      <th>Details</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><img src="images/ticket-icons/cbvid.png" class="ticket-icon" /> <b>CBV ID</b></td>
      <td><?php echo $row["name"]." - ".$row["custom2"]; ?></td>
    </tr>
    <tr>
      <td><img src="images/ticket-icons/processor.png" class="ticket-icon" /> <b>Processor</b></td>
      <td><?php echo $row["custom3"]." ". $row["custom4"]; ?> Ghz</td>
    </tr>
    <tr>
      <td><img src="images/ticket-icons/memory.png" class="ticket-icon" /> <b>Memory</b></td>
      <td><?php echo $row["custom5"]; ?> GB</td>
    </tr>
    <tr>
      <td><img src="images/ticket-icons/storage.png" class="ticket-icon" /> <b>Storage</b></td>
      <td><?php echo $row["custom6"]; ?> GB</td>
    </tr>
    <tr>
      <td><img src="images/ticket-icons/extras.png" class="ticket-icon" /> <b>Extras</b></td>
      <td><?php if($row["custom7"]){echo $row["custom7"]. "in screen ";};
		if($row["custom8"]){echo $row["custom8"]. " ";};
		if($row["custom9"]){echo $row["custom9"]. "";};; ?></td>
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
