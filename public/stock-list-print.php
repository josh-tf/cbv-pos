<?php
// using docker env vars
$servername = getenv('MYSQL_HOST_NAME');
$username = getenv('MYSQL_USERNAME');
$password = getenv('MYSQL_PASSWORD');
$dbname = getenv('MYSQL_DB_NAME');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT *";
$sql .= " FROM";
$sql .= "     cbvpos_item_quantities t1";
$sql .= "         INNER JOIN";
$sql .= "     cbvpos_items t2 ON t1.item_id = t2.item_id";
$sql .= " WHERE";
$sql .= " 	quantity > 0 AND";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Computerbank Stocklist - <?php echo date('D d M y'); ?></title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="css/extra/normalize.css">
  <link rel="stylesheet" href="css/extra/stocklist.css">

  <style>@page { size: A4 landscape }</style>

  <style type="text/css">

  </style>

</head>

	<body onload="window.print()" class="A4 landscape">

	  <section class="sheet padding-10mm">
		<div class="row">

			<div class="desktop-stocklist">

    	<img src="images/cbv-logo-black.png" class="logo"/>

			<h1 class="head">Computerbank: Desktop Stocklist</h1>

					<table class="u-full-width">
						<thead>
						<tr>
    <th>ID</th>
    <th>Type</th>
    <th>Concession Price</th>
    <th>Retail Price</th>
    <th>Model</th>
    <th>CPU Type</th>
    <th>CPU Speed</th>
    <th>RAM</th>
    <th>HDD</th>
    <th>Screen Size</th>
    <th>Optical Drive</th>
    <th>Notes (Extras, etc)</th>
    <th>Operating System</th>
    </tr>
						</thead>
						<tbody>

					<?php
$cat = "Desktop";
$stmt = $conn->prepare($sql . ' category = ? ORDER BY unit_price;');
$stmt->bind_param('s', $cat); // 's' specifies the variable type => 'string'

$stmt->execute();

$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    ?>

    <tr>
      <td><?php echo $row["name"]; ?></td>
      <td><?php echo ($row["custom10"]) ? $row["custom10"] : "Tower"; // type  ?></td>
      <td>$<?php echo number_format((float) ($row["unit_price"]), 2, '.', ''); ?></td>
      <td>$<?php echo number_format((float) ($row["unit_price"]) * 1.5, 2, '.', ''); ?></td>
      <td><?php echo $row["custom2"]; //brand/model   ?></td>
      <td><?php echo $row["custom3"]; // cpu type  ?></td>
      <td><?php echo $row["custom4"]; // cpu speed  ?> Ghz</td>
      <td><?php echo $row["custom5"]; // ram  ?> GB</td>
      <td><?php echo $row["custom6"]; // hdd  ?> GB</td>
      <td><?php echo $row["custom8"]; // screen  ?>in</td>
      <td><?php echo ($row["custom9"]) ? $row["custom9"] : "None"; // optical drive  ?></td>
      <td><?php echo ($row["custom13"]) ? $row["custom13"] : "None"; // extras  ?></td>
      <td><?php echo $row["custom7"]; // operating system  ?></td>
    </tr>

					<?php
}
?>
						</tbody>
						</table>

<br>

<h3>Printed at <?php echo date('D d M y'); ?></h3>

</div>

			<div class="laptop-stocklist">

    	<img src="images/cbv-logo-black.png" class="logo"/>

			<h1 class="head">Computerbank: Laptop Stocklist</h1>

					<table class="u-full-width">
						<thead>
						<tr>
    <th>ID</th>
    <th>Concession Price</th>
    <th>Model</th>
    <th>CPU Type</th>
    <th>CPU Speed</th>
    <th>RAM</th>
    <th>HDD</th>
    <th>Screen Size</th>
    <th>Optical Drive</th>
    <th>Battery Life</th>
    <th>Notes (Extras, etc)</th>
    <th>Operating System</th>
    </tr>
						</thead>
						<tbody>

					<?php
$cat = "Laptop";
$stmt = $conn->prepare($sql . ' category = ? ORDER BY unit_price;');
$stmt->bind_param('s', $cat); // 's' specifies the variable type => 'string'

$stmt->execute();

$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    ?>

    <tr>
      <td><?php echo $row["name"]; ?></td>
      <td>$<?php echo number_format((float) ($row["unit_price"]), 2, '.', ''); ?></td>
      <td><?php echo $row["custom2"]; //brand/model   ?></td>
      <td><?php echo $row["custom3"]; // cpu type  ?></td>
      <td><?php echo $row["custom4"]; // cpu speed  ?> Ghz</td>
      <td><?php echo $row["custom5"]; // ram  ?> GB</td>
      <td><?php echo $row["custom6"]; // hdd  ?> GB</td>
      <td><?php echo $row["custom8"]; // screen  ?>in</td>
      <td><?php echo ($row["custom9"]) ? $row["custom9"] : "None"; // optical drive  ?></td>
      <td><?php echo $row["custom11"]; // battery life  ?> hrs</td>
      <td><?php echo ($row["custom13"]) ? $row["custom13"] : "None"; // extras  ?></td>
      <td><?php echo $row["custom7"]; // operating system  ?></td>
    </tr>

					<?php
}
?>
						</tbody>
					</table>

						<br>

						<h3>Printed at <?php echo date('D d M y'); ?></h3>

				</div>
			</div>
		</section>

</body>

</html>
