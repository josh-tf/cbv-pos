<?php

// using docker env vars
$servername = getenv('MYSQL_HOST_NAME');
$username = getenv('MYSQL_USERNAME');
$password = getenv('MYSQL_PASSWORD');
$dbname = getenv('MYSQL_DB_NAME');

$concID = htmlspecialchars($_GET['conc-id']);

if(!$concID){
  die('Invalid ID provided');
}

$saleRange = ucfirst(htmlspecialchars($_GET['range']));

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT *";
$sql .= " FROM";
$sql .= "     cbvpos_customers t1";
$sql .= "         INNER JOIN";
$sql .= "     cbvpos_people t2 ON t1.person_id = t2.person_id";
$sql .= " WHERE";
$sql .= " 	company_name = '" . $concID . "'";

$stmt = $conn->prepare($sql);

$stmt->execute();

$result = $stmt->get_result();
$matchCount = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <title>Customer Concession ID Lookup - <?php echo $concID; ?></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">

  <link rel="stylesheet" href="css/extra/normalize.css">
  <link rel="stylesheet" href="css/extra/skeleton.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

  <style type="text/css">
    table {
      border-collapse: collapse;
    }
    th, td {
      padding: 5px 10px;
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

<h5>Lookup for Concession ID [<b><?php echo $concID ?></b>] - <?php echo ($matchCount > 1) ? "<b style='color:#F33'>Multiple Matches!</b>" : "No Duplicates"  ?></h5>
<p>There are <?php echo $matchCount; ?> matches for this concession ID in the customer database.</p>

<table class="u-full-width">
<thead>
    <tr>
    <th>Person ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Address</th>
    <th>Comments</th>
    </tr>
  </thead>
  <tbody>

<?php

while ($row = $result->fetch_assoc()) {
    ?>

    <tr>
      <td><?php echo $row['person_id']; ?></td>
      <td><?php echo $row['first_name']; ?></td>
      <td><?php echo $row['last_name']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['address_1']; ?> <?php echo $row['address_2']; ?> <?php echo $row['city']; ?></td>
      <td style="font-weight:bold;color:#F33;font-size: 1.2em;"><?php echo $row['comments']; ?></td>
    </tr>

<?php
}
?>
  </tbody>
</table>

<?php

$searchRange = new DateTime();

switch ($saleRange) {
  case 'Week':
          $searchRange->modify('-1 week');
      break;
  case 'Month':
          $searchRange->modify('-1 month');
      break;
  case 'Year':
          $searchRange->modify('-1 year');
      break;
      default:
      $searchRange->modify('-10 years');
      $saleRange = 'All Time';
}

if($saleRange == 'All Time'){
    $timeString = $saleRange;
  }else{
    $timeString = $saleRange . ' (from ' . $searchRange->format('d m Y') . ')';
  }

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT *";
$sql .= " FROM";
$sql .= "     cbvpos_sales t1";
$sql .= "         INNER JOIN";
$sql .= "     cbvpos_customers t2 ON t1.customer_id = t2.person_id";
$sql .= "         INNER JOIN";
$sql .= "     cbvpos_sales_items t3 ON t1.sale_id = t3.sale_id";
$sql .= "         INNER JOIN";
$sql .= "     cbvpos_items t4 ON t3.item_id = t4.item_id";
$sql .= "         INNER JOIN";
$sql .= "     cbvpos_people t5 ON t2.person_id = t5.person_id";
$sql .= " WHERE";
$sql .= " 	company_name = '" . $concID .  "' AND sale_time >= '" . $searchRange->format('Y-m-d H:i:s') . "';";

$stmt = $conn->prepare($sql);

$stmt->execute();
$result = $stmt->get_result();

$stmt->execute();
$resultCount = $stmt->get_result();

$matchCount = mysqli_num_rows($result);

$totalSpent= 0;
while ($num = mysqli_fetch_assoc($resultCount)) {
    $totalSpent += $num['unit_price'];
}

$stmt->execute();
$discountCount = $stmt->get_result();

$discCount = mysqli_num_rows($result);

$discTotal= 0;
while ($num = mysqli_fetch_assoc($discountCount)) {
    $discTotal += $num['discount_percent'];
}

?>

<br><br>

<h5>Sales for Concession ID [<b><?php echo $concID ?></b>] - <?php echo $timeString ?></h5>
<p>There are <?php echo $matchCount; ?> matches for this concession ID in the sales database.</p>

<table>
<thead>
<tr>
<th>Description</th>
<th>Total Amount</th>
<th>Time Period</th>
</tr>
</thead>
<tbody>
<tr>
<td>Total Spent</td>
<td>$<?php echo number_format((float) ($totalSpent-$discTotal), 2, '.', ''); ?></td>
<td><?php echo $saleRange ?></td>
</tr>
<tr>
<td>Total Discount</td>
<td>$<?php echo number_format((float) ($discTotal), 2, '.', ''); ?></td>
<td><?php echo $saleRange ?></td>
</tr>

</tbody>
</table>

<?php
$siteurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (strpos($siteurl, '&')){ //if no param provided
  $siteurl = strstr($siteurl, '&', true);
}
?>

</table>
<table>
<tbody>
<tr>
<td><b>Search Period</b></td>
<td><a href="<?php echo $siteurl . '&range=week'; ?>" class="button-<?php echo ($saleRange == 'Week') ? 'secondary' : 'warning'; ?> pure-button">Week</a></td>
<td><a href="<?php echo $siteurl . '&range=month'; ?>" class="button-<?php echo ($saleRange == 'Month') ? 'secondary' : 'warning'; ?>  pure-button">Month</a></td>
<td><a href="<?php echo $siteurl . '&range=year'; ?>" class="button-<?php echo ($saleRange == 'Year') ? 'secondary' : 'warning'; ?>  pure-button">Year</a></td>
<td><a href="<?php echo $siteurl . '&range=alltime'; ?>" class="button-<?php echo ($saleRange == 'All Time') ? 'secondary' : 'warning'; ?>  pure-button">All Time</a></td>
</tr>
</tbody>
</table>

<table class="u-full-width">
<thead>
    <tr>
    <th>Person ID</th>
    <th>Sale Date</th>
    <th>Item Name</th>
    <th>Unit Price</th>
    <th>Discount</th>
    <th>Amount Paid</th>
    <th>Description</th>
    </tr>
  </thead>
  <tbody>

<?php

while ($row = $result->fetch_assoc()) {
    ?>

    <tr>
      <td><?php echo $row['person_id']; ?> (<?php echo $row['first_name']; ?>)</td>
      <td><?php echo $row['sale_time']; ?></td>
      <td><?php echo $row['name']; ?> (<?php echo $row['category']; ?>)</td>
      <td>$<?php echo number_format((float) ($row['unit_price']), 2, '.', ''); ?></td>
      <td>$<?php echo number_format((float) ($row['discount_percent']), 2, '.', ''); ?></td>
      <td>$<?php echo number_format((float) ($row['unit_price']-$row['discount_percent']), 2, '.', ''); ?></td>
      <td><?php echo $row['description']; ?></td>
    </tr>

<?php
}
?>

      </div>
    </div>
  </div>

</body>

</html>