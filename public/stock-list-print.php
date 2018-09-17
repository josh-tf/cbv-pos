<?php
// using docker env vars
$servername = getenv('MYSQL_HOST_NAME');
$username = getenv('MYSQL_USERNAME');
$password = getenv('MYSQL_PASSWORD');
$dbname = getenv('MYSQL_DB_NAME');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT";
$sql.= "     `name`,`unit_price`, `custom3`,`custom4`,`custom5`,`custom6`,`custom7`,`custom8`,`custom9`,`quantity`";
$sql.= " FROM";
$sql.= "     cbvpos_item_quantities t1";
$sql.= "         INNER JOIN";
$sql.= "     cbvpos_items t2 ON t1.item_id = t2.item_id";
$sql.= " WHERE";
$sql.= " 	quantity > 0 AND";

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

	<body class="A4 landscape">

	  <section class="sheet padding-10mm">
		<div class="row">

			<div class="desktop-stocklist">

    	<img src="images/cbv-logo-black.png" class="logo"/>

			<h1 class="head">Computerbank: Desktop Stocklist</h1>

					<table class="u-full-width">
						<thead>
						<tr>
							<th>ID</th>
							<th>Conc. Price</th>
							<th>Market Price</th>
							<th>Processor</th>
							<th>Memory</th>
							<th>Storage</th>
							<th>Extras</th>
						</tr>
						</thead>
						<tbody>

					<?php
					$cat = "Desktop";
					$stmt = $conn->prepare($sql.' category = ?;');
					$stmt->bind_param('s',$cat); // 's' specifies the variable type => 'string'

					$stmt->execute();

					$result = $stmt->get_result();
					while ($row = $result->fetch_assoc()) {
					?>

						<tr>
							<td><?php echo $row["name"]; ?></td>
							<td>$<?php echo number_format((float)round(($row["unit_price"])/5) * 5, 2, '.', ''); ?></td>
							<td>$<?php echo number_format((float)round(($row["unit_price"] * 1.25)/5) * 5, 2, '.', ''); ?></td>
							<td><?php echo $row["custom3"]." ". $row["custom4"]; ?> Ghz</td>
							<td><?php echo $row["custom5"]; ?> GB</td>
							<td><?php echo $row["custom6"]; ?> GB</td>
							<td><?php if($row["custom7"]){echo $row["custom7"]. "in screen ";};
							if($row["custom8"]){echo $row["custom8"]. " ";};
							if($row["custom9"]){echo $row["custom9"]. "";};; ?></td>
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
							<th>Conc. Price</th>
							<th>Market Price</th>
							<th>Processor</th>
							<th>Memory</th>
							<th>Storage</th>
							<th>Extras</th>
						</tr>
						</thead>
						<tbody>

					<?php
					$cat = "Laptop";
					$stmt = $conn->prepare($sql.' category = ?;');
					$stmt->bind_param('s',$cat); // 's' specifies the variable type => 'string'

					$stmt->execute();

					$result = $stmt->get_result();
					while ($row = $result->fetch_assoc()) {
					?>

						<tr>
							<td><?php echo $row["name"]; ?></td>
							<td>$<?php echo number_format((float)round(($row["unit_price"])/5) * 5, 2, '.', ''); ?></td>
							<td>$<?php echo number_format((float)round(($row["unit_price"] * 1.25)/5) * 5, 2, '.', ''); ?></td>
							<td><?php echo $row["custom3"]." ". $row["custom4"]; ?> Ghz</td>
							<td><?php echo $row["custom5"]; ?> GB</td>
							<td><?php echo $row["custom6"]; ?> GB</td>
							<td><?php if($row["custom7"]){echo $row["custom7"]. "in screen ";};
							if($row["custom8"]){echo $row["custom8"]. " ";};
							if($row["custom9"]){echo $row["custom9"]. "";};; ?></td>
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
