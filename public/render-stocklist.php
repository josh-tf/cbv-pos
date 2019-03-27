<plaintext><h3>Desktops</h3>
The listed concession price is only available to concession card holders. Please have a valid concession card ready when you make your purchase. You may purchase a desktop computer without a concession card, but you will be charged our market price, as shown below.


<?php
$dt = new DateTime('now', new DateTimezone('Australia/Melbourne'));

$servername = getenv('MYSQL_HOST_NAME');
$username = getenv('MYSQL_USERNAME');
$password = getenv('MYSQL_PASSWORD');
$dbname = getenv('MYSQL_DB_NAME');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ";
$sql .= "i.name AS CBVID, ";
$sql .= "i.unit_price AS ConcPrice, ";
$sql .= "i.custom2 AS Model, ";
$sql .= "i.custom3 AS CPUType, ";
$sql .= "i.custom4 AS CPUSpeed, ";
$sql .= "i.custom5 AS RAM, ";
$sql .= "i.custom6 AS HDD, ";
$sql .= "i.custom8 AS Screen, ";
$sql .= "i.custom9 AS DVD ";

$sql .= "FROM cbvpos_items AS i INNER JOIN cbvpos_item_quantities q ON i.item_id = q.item_id ";
$sql .= "WHERE i.category = 'Desktop' AND q.quantity > 0 ";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

echo "[su_tabs vertical='yes']";

    // output data of each row
    while($row = $result->fetch_assoc()) {
    ?>


[su_tab title="<b class='cbvID'>ID: <?php echo $row["CBVID"] ?></b> <b class='cbvIDPrice'>$<?php echo number_format((float) ($row["ConcPrice"]), 2, '.', ''); ?></b> <?php echo $row["Model"] ?>" disabled="no" anchor="" url="" target="blank" class=""]
<table style="max-width: 353px; height: 100px;" width="273">
<tbody>
<tr>
<td style="width: 58px;" colspan="3"><img class="aligncenter wp-image-5674" src="https://cbv.josh.tf/wp-content/uploads/2019/03/googlelogo_color_116x41dp.png" alt="" width="180" /></td>
</tr>
<tr>
<td style="width: 58px; text-align: center;" colspan="3"><strong><?php echo $row["Model"] ?> - $<?php echo number_format((float) ($row["ConcPrice"]), 2, '.', ''); ?> </strong>($<?php echo number_format((float) ($row["ConcPrice"]) * 1.5, 2, '.', ''); ?>) ID: <?php echo $row["CBVID"] ?></td>
</tr>
<tr>
<td style="width: 58px;"><img src="https://cbv.josh.tf/wp-content/uploads/2018/03/processor-bit-064-icon.png" alt="" width="16" height="16" /> <?php echo $row["CPUType"] ?> <?php echo $row["CPUSpeed"] ?></td>
<td style="width: 59px;"><img src="https://cbv.josh.tf/wp-content/uploads/2018/03/Devices-drive-harddisk-icon.png" alt="" width="16" height="16" /> <?php echo $row["HDD"] ?> GB</td>
<td style="width: 59px;"><img src="https://cbv.josh.tf/wp-content/uploads/2018/03/DVD-icon.png" alt="" width="16" height="16" /><?php echo $row["DVD"] ? $row["DVD"] : 'None'; ?></td>
</tr>
<tr>
<td style="width: 58px;"><img src="https://cbv.josh.tf/wp-content/uploads/2018/03/RAM-icon.png" alt="" width="16" height="16" /><?php echo $row["RAM"] ?> GB</td>
<td style="width: 59px;"><img src="https://cbv.josh.tf/wp-content/uploads/2018/03/linux-icon.png" alt="" width="16" height="16" /> Ubuntu</td>
<td style="width: 59px;"><img src="https://cbv.josh.tf/wp-content/uploads/2018/03/06-Computer-Windows-7-icon.png" alt="" width="16" height="16" /> <?php echo $row["Screen"] ?> in</td>
</tr>
</tbody>
</table>
<b>Included with this machine:</b>
<ul>
 	<li>Ubuntu Linux 16.04 (Computerbank Edition)</li>
 	<li>USB Keyboard and Mouse set</li>
 	<li>LCD Monitor (Size listed above)</li>
 	<li>All required cables</li>
 	<li><a href="https://cbv.josh.tf/about-us/our-computers/">3 Month warranty</a></li>
 	<li><a href="https://cbv.josh.tf/about-us/our-computers/">User Guide</a></li>
</ul>
[/su_tab]

<?php

    }
    echo "[/su_tabs]";

} else {
    echo "<b><i>No desktops are currently in stock</i></b>";
}
?>


<h3>Laptops</h3>
Laptops are first come, first served. You must have a valid concession card to purchase a laptop. Strictly one laptop per customer.


<?php

$sql = "SELECT ";
$sql .= "i.name AS CBVID, ";
$sql .= "i.unit_price AS ConcPrice, ";
$sql .= "i.custom2 AS Model, ";
$sql .= "i.custom3 AS CPUType, ";
$sql .= "i.custom4 AS CPUSpeed, ";
$sql .= "i.custom5 AS RAM, ";
$sql .= "i.custom6 AS HDD, ";
$sql .= "i.custom8 AS Screen, ";
$sql .= "i.custom11 AS Battery ";

$sql .= "FROM cbvpos_items AS i INNER JOIN cbvpos_item_quantities q ON i.item_id = q.item_id ";
$sql .= "WHERE i.category = 'Laptop' AND q.quantity > 0 ";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

echo "[su_tabs vertical='yes']";

    // output data of each row
    while($row = $result->fetch_assoc()) {
    ?>


[su_tab title="<b class='cbvID'>ID: <?php echo $row["CBVID"] ?></b> <b class='cbvIDPrice'>$<?php echo number_format((float) ($row["ConcPrice"]), 2, '.', ''); ?></b> <?php echo $row["Model"] ?>" disabled="no" anchor="" url="" target="blank" class=""]
<table style="max-width: 353px; height: 100px;" width="273">
<tbody>
<tr>
<td style="width: 58px;" colspan="3"><img class="aligncenter wp-image-5674" src="https://cbv.josh.tf/wp-content/uploads/2019/03/googlelogo_color_116x41dp.png" alt="" width="180" /></td>
</tr>
<tr>
<td style="width: 58px; text-align: center;" colspan="3"><strong><?php echo $row["Model"] ?> - $<?php echo number_format((float) ($row["ConcPrice"]), 2, '.', ''); ?> </strong>($<?php echo number_format((float) ($row["ConcPrice"]) * 1.5, 2, '.', ''); ?>) ID: <?php echo $row["CBVID"] ?></td>
</tr>
<tr>
<td style="width: 58px;"><img src="https://cbv.josh.tf/wp-content/uploads/2018/03/processor-bit-064-icon.png" alt="" width="16" height="16" /> <?php echo $row["CPUType"] ?> <?php echo $row["CPUSpeed"] ?></td>
<td style="width: 59px;"><img src="https://cbv.josh.tf/wp-content/uploads/2018/03/Devices-drive-harddisk-icon.png" alt="" width="16" height="16" /> <?php echo $row["HDD"] ?> GB</td>
<td style="width: 59px;"><img src="https://cbv.josh.tf/wp-content/uploads/2018/03/battery-3-icon.png" alt="" width="16" height="16" /><?php echo $row["Battery"] ?> Hrs</td>
</tr>
<tr>
<td style="width: 58px;"><img src="https://cbv.josh.tf/wp-content/uploads/2018/03/RAM-icon.png" alt="" width="16" height="16" /><?php echo $row["RAM"] ?> GB</td>
<td style="width: 59px;"><img src="https://cbv.josh.tf/wp-content/uploads/2018/03/linux-icon.png" alt="" width="16" height="16" /> Ubuntu</td>
<td style="width: 59px;"><img src="https://cbv.josh.tf/wp-content/uploads/2018/03/06-Computer-Windows-7-icon.png" alt="" width="16" height="16" /> <?php echo $row["Screen"] ?> in</td>
</tr>
</tbody>
</table>
<b>Included with this machine:</b>
<ul>
 	<li>Ubuntu Linux 16.04 (Computerbank Edition)</li>
 	<li>Laptop Care Guide</li>
 	<li>Tested Power Adaptor</li>
 	<li><a href="https://cbv.josh.tf/about-us/our-computers/">3 Month warranty</a></li>
 	<li><a href="https://cbv.josh.tf/about-us/our-computers/">User Guide</a></li>
</ul>
[/su_tab]

<?php

    }
    echo "[/su_tabs]";

} else {
    echo "<b><i>No laptops are currently in stock</i></b>";
}
$conn->close();
?>


<span style="color: #808080;">Last modified on <?php echo $dt->format('d-M-y') . ' at ' . $dt->format('h:i a'); ?></span>
