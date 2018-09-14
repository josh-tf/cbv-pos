<?php
// grab our ID from the url
$cbvid = htmlspecialchars($_GET["id"]);

// exit if the id is empty
//if (empty($cbvid)) {
//    die("Invalid ID Provided");
//}

// using docker env vars
$servername = getenv('MYSQL_HOST_NAME');
$username = getenv('MYSQL_USERNAME');
$password = getenv('MYSQL_PASSWORD');
$dbname = getenv('MYSQL_DB_NAME');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT 													";
$sql.= "     `name`, 											";
$sql.= "     `unit_price`,										";
$sql.= "     `custom3`,											";
$sql.= "     `custom4`,											";
$sql.= "     `custom5`,											";
$sql.= "     `custom6`,											";
$sql.= "     `custom7`,											";
$sql.= "     `custom8`,											";
$sql.= "     `custom9`,											";
$sql.= "     `quantity`											";
$sql.= " FROM													";
$sql.= "     cbvpos_item_quantities t1							";
$sql.= "         INNER JOIN										";
$sql.= "     cbvpos_items t2 ON t1.item_id = t2.item_id			";
$sql.= " WHERE													";
$sql.= " 	quantity > 0 AND									";
$sql.= " 														";

?>


<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <title>Computerbank Stocklist</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">

  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  
  <script src="./js/stupidtable.js"></script>

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

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div class="container">
    <div class="row">
      <div class="" style="margin: 5% 0">
		
<h5>Desktops</h5>
<p>The listed concession price is only available to concession card holders. Please have a valid concession card ready when you make your purchase. You may purchase a desktop computer without a concession card, but you will be charged our market price, as shown below.</p>

<table class="sorter-dt u-full-width">
  <thead>
    <tr>
      <th data-sort="string">ID</th>
      <th data-sort="string">Conc. Price</th>
      <th data-sort="string">Market Price</th>
      <th data-sort="string">Processor</th>
      <th data-sort="string">Memory</th>
      <th data-sort="string">Storage</th>
      <th data-sort="string">Extras</th>
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

<br><br>

<h5>Laptops</h5>
<p>Laptops are first come, first served. You must have a valid concession card to purchase a laptop. Strictly one laptop per customer.

</p>

<table class="sorter-lt u-full-width">
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

<br><br>

      </div>
    </div>
  </div>
  
</body>

  <script>
    $(function(){
        $(".sorter-dt").stupidtable();
		$(".sorter-lt").stupidtable();
    });
  </script>
</html>