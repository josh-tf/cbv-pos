<?php

// using docker env vars
$servername = getenv('MYSQL_HOST_NAME');
$username = getenv('MYSQL_USERNAME');
$password = getenv('MYSQL_PASSWORD');
$dbname = getenv('MYSQL_DB_NAME');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = 'SELECT *';
$sql .= ' FROM';
$sql .= '     cbvpos_item_quantities t1';
$sql .= '         INNER JOIN';
$sql .= '     cbvpos_items t2 ON t1.item_id = t2.item_id';
$sql .= ' WHERE';
$sql .= ' 	quantity > 0 AND';

?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <title>Computerbank Stocklist - <?php echo date('D d M y'); ?></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="css/extra/normalize.css">
  <link rel="stylesheet" href="css/extra/skeleton.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

  <style type="text/css">
    table {
      border-collapse: collapse;
    }
    th, td {
      padding: 3px 3px;
      border: 1px solid #999;
    }
    th {
      background-color: #eee;
    }
    th[data-sort]{
      cursor:pointer;
    }
    tr.awesome{
      color: red;
    }
th:first-child, td:first-child {
    padding-left: 10px !important;
}
.u-full-width {
    width: 100% !important;
}
body {
    font-size: 1.2em !important;
}
  </style>


</head>
<body>

  <div class="container">
    <div class="row">
      <div class="" style="margin: 5% 0">

<h5>Desktops</h5>
<p>The listed concession price is only available to concession card holders. Please have a valid concession card ready when you make your purchase. You may purchase a desktop computer without a concession card, but you will be charged our market price, as shown below.</p>

<table class="u-full-width">
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
$cat = 'Desktop';
$stmt = $conn->prepare($sql . ' category = ? ORDER BY unit_price;');
$stmt->bind_param('s', $cat); // 's' specifies the variable type => 'string'

$stmt->execute();

$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    ?>

    <tr>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo ($row['custom10']) ? $row['custom10'] : 'Tower'; // type  ?></td>
      <td>$<?php echo number_format((float) ($row['unit_price']), 2, '.', ''); ?></td>
      <td>$<?php echo number_format((float) ($row['unit_price']) * 1.5, 2, '.', ''); ?></td>
      <td><?php echo $row['custom2']; //brand/model   ?></td>
      <td><?php echo $row['custom3']; // cpu type  ?></td>
      <td><?php echo $row['custom4']; // cpu speed  ?> Ghz</td>
      <td><?php echo $row['custom5']; // ram  ?> GB</td>
      <td><?php echo $row['custom6']; // hdd  ?> GB</td>
      <td><?php echo $row['custom8']; // screen  ?>in</td>
      <td><?php echo ($row['custom9']) ? $row['custom9'] : 'None'; // optical drive  ?></td>
      <td><?php echo ($row['custom13']) ? $row['custom13'] : 'None'; // extras  ?></td>
      <td><?php echo $row['custom7']; // operating system  ?></td>
    </tr>

<?php
}
?>
  </tbody>
</table>

<br><br>

<h5>Laptops</h5>
<p>Laptops are first come, first served. You must have a valid concession card to purchase a laptop. Strictly one laptop per customer.

</p>

<table class="u-full-width">


<table>
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
$cat = 'Laptop';
$stmt = $conn->prepare($sql . ' category = ? ORDER BY unit_price;');
$stmt->bind_param('s', $cat); // 's' specifies the variable type => 'string'

$stmt->execute();

$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    ?>

    <tr>
      <td><?php echo $row['name']; ?></td>
      <td>$<?php echo number_format((float) ($row['unit_price']), 2, '.', ''); ?></td>
      <td><?php echo $row['custom2']; //brand/model   ?></td>
      <td><?php echo $row['custom3']; // cpu type  ?></td>
      <td><?php echo $row['custom4']; // cpu speed  ?> Ghz</td>
      <td><?php echo $row['custom5']; // ram  ?> GB</td>
      <td><?php echo $row['custom6']; // hdd  ?> GB</td>
      <td><?php echo $row['custom8']; // screen  ?>in</td>
      <td><?php echo ($row['custom9']) ? $row['custom9'] : 'None'; // optical drive  ?></td>
      <td><?php echo $row['custom11']; // battery life  ?> hrs</td>
      <td><?php echo ($row['custom13']) ? $row['custom13'] : 'None'; // extras  ?></td>
      <td><?php echo $row['custom7']; // operating system  ?></td>
    </tr>

<?php
}
?>
  </tbody>
</table>

<br><br>

      </div>
    </div>
  </div>

</body>

</html>