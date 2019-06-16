<?php
define('WP_USE_THEMES', false);
require_once './wp-load.php';

ob_start();
?>

<h3>Desktops</h3>
The listed concession price is only available to concession card holders. Please have a valid concession card ready when you make your purchase, you may purchase a desktop computer without a concession card however you will be charged our market price, as shown in brackets.

<?php
$dt = new DateTime('now', new DateTimezone('Australia/Melbourne'));

$servername = getenv('MYSQL_HOST_NAME');
$username = getenv('POS_MYSQL_USERNAME');
$password = getenv('POS_MYSQL_PASSWORD');
$dbname = getenv('POS_MYSQL_DB_NAME');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sql = 'SELECT ';
$sql .= 'i.category AS Category, ';
$sql .= 'i.name AS CBVID, ';
$sql .= 'i.unit_price AS ConcPrice, ';
$sql .= 'i.custom2 AS Model, ';
$sql .= 'i.custom3 AS CPUType, ';
$sql .= 'i.custom4 AS CPUSpeed, ';
$sql .= 'i.custom5 AS RAM, ';
$sql .= 'i.custom6 AS HDD, ';
$sql .= 'i.custom8 AS Screen, ';
$sql .= 'i.custom9 AS DVD, ';
$sql .= 'i.custom11 AS Battery ';

$sql .= 'FROM items AS i INNER JOIN item_quantities q ON i.item_id = q.item_id ';
$sql .= 'WHERE (i.category = "Desktop" OR i.category = "Laptop") AND (q.quantity > 0) AND (on_hold = FALSE) AND (stock_type != 1)';
$sql .= 'ORDER BY ConcPrice ASC;';

$stocklist = $conn->query($sql);

$desktopCount = 0;
$laptopCount = 0;

if ($stocklist->num_rows > 0) {
    while ($row = $stocklist->fetch_assoc()) {
        if (($row['Category'] === 'Desktop')) {
            $desktopCount++;
        } elseif (($row['Category'] === 'Laptop')) {
            $laptopCount++;
        }
    }
}

mysqli_data_seek($stocklist, 0); // back to the start of the recordset

if ($desktopCount > 0) {
    echo "[su_tabs vertical='yes']";

    // output data of each row
    while ($row = $stocklist->fetch_assoc()) {
        if (!($row['Category'] === 'Desktop')) {
            continue;
        } ?>


[su_tab title="<b class='cbvID'>ID: <?php echo $row['CBVID'] ?></b> <b class='cbvIDPrice'>$<?php echo number_format((float) ($row['ConcPrice']), 2, '.', ''); ?></b> <?php echo $row['Model'] ?>" disabled="no" anchor="" url="" target="blank" class="']
<table style="max-width: 353px; height: 100px;" width="273">
<tbody>
<tr>
<td style="width: 58px;" colspan="3"><img class="aligncenter wp-image-5674" src="<?php echo $siteurl; ?>/wp-content/stocklist-icons/computerbank.png" alt="" width="180" /></td>
</tr>
<tr>
<td class="stocklist-model-banner" colspan="3"><strong><?php echo $row['Model'] ?></strong> (ID: <?php echo $row['CBVID'] ?>)</td>
</tr>
<tr>
<td style="width: 60px;"><img src="/wp-content/stocklist-icons/cpu.png" style="width:16px;height:16px;margin-bottom:-3px;" /> <?php echo $row['CPUType'] ?> <?php echo $row['CPUSpeed'] ?></td>
<td style="width: 85px;"><img src="/wp-content/stocklist-icons/hdd.png" style="width:16px;height:16px;margin-bottom:-3px;" /> <?php echo $row['HDD'] ?></td>
<td style="width: 60px;"><img src="/wp-content/stocklist-icons/dvd.png" style="width:16px;height:16px;margin-bottom:-3px;" /> <?php echo $row['DVD'] ?></td>
</tr>
<tr>
<td style="width: 60px;"><img src="/wp-content/stocklist-icons/ram.png" style="width:16px;height:16px;margin-bottom:-3px;" /> <?php echo $row['RAM'] ?> GB</td>
<td style="width: 85px;"><img src="/wp-content/stocklist-icons/os.png" style="width:16px;height:16px;margin-bottom:-3px;" /> Ubuntu</td>
<td style="width: 60px;"><img src="/wp-content/stocklist-icons/screen.png" style="width:16px;height:16px;margin-bottom:-3px;" /> <?php echo $row['Screen'] ?> in</td>
</tr>
<tr>
<td style="width: 60px; text-align: center;" colspan="3"><strong>Concession:</strong> $<?php echo number_format((float) ($row['ConcPrice']), 2, '.', ''); ?> | <strong>Full Price:</strong> $<?php echo number_format((float) ($row['ConcPrice']) * 1.5, 2, '.', ''); ?></td>
</tr>
</tbody>
</table>
<b>Included with this machine:</b>
<ul>
 	<li>Ubuntu Linux 16.04 (Computerbank Edition)</li>
 	<li>USB Keyboard and Mouse set</li>
 	<li>LCD Monitor (Size listed above)</li>
 	<li>All required cables</li>
 	<li><a href="/about-us/our-computers/">3 Month warranty</a></li>
 	<li><a href="/about-us/our-computers/">User Guide</a></li>
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
Laptops are first come, first served. You must have a valid concession card to purchase a laptop and there is a one per person limit.


<?php

if ($laptopCount > 0) {
    echo "[su_tabs vertical='yes']";

    mysqli_data_seek($stocklist, 0); // back to the start of the recordset

    // output data of each row
    while ($row = $stocklist->fetch_assoc()) {
        if (!($row['Category'] === "Laptop")) {
            continue;
        } ?>

[su_tab title="<b class='cbvID'>ID: <?php echo $row['CBVID'] ?></b> <b class='cbvIDPrice'>$<?php echo number_format((float) ($row['ConcPrice']), 2, '.', ''); ?></b> <?php echo $row['Model'] ?>" disabled="no" anchor="" url="" target="blank" class="']
<table style="max-width: 353px; height: 100px;" width="273">
<tbody>
<tr>
<td style="width: 58px;" colspan="3"><img class="aligncenter wp-image-5674" src="/wp-content/stocklist-icons/computerbank.png" alt="" width="180" /></td>
</tr>
<tr>
<td class="stocklist-model-banner" colspan="3"><strong><?php echo $row['Model'] ?></strong> (ID: <?php echo $row['CBVID'] ?>)</td>
</tr>
<tr>
<td style="width: 60px;"><img src="/wp-content/stocklist-icons/cpu.png" style="width:16px;height:16px;margin-bottom:-3px;" /> <?php echo $row['CPUType'] ?> <?php echo $row['CPUSpeed'] ?></td>
<td style="width: 85px;"><img src="/wp-content/stocklist-icons/hdd.png" style="width:16px;height:16px;margin-bottom:-3px;" /> <?php echo $row['HDD'] ?></td>
<td style="width: 60px;"><img src="/wp-content/stocklist-icons/battery.png" style="width:16px;height:16px;margin-bottom:-3px;" /> <?php echo $row['Battery'] ?> Hrs</td>
</tr>
<tr>
<td style="width: 60px;"><img src="/wp-content/stocklist-icons/ram.png" style="width:16px;height:16px;margin-bottom:-3px;" /> <?php echo $row['RAM'] ?> GB</td>
<td style="width: 85px;"><img src="/wp-content/stocklist-icons/os.png" style="width:16px;height:16px;margin-bottom:-3px;" /> Ubuntu</td>
<td style="width: 60px;"><img src="/wp-content/stocklist-icons/screen.png" style="width:16px;height:16px;margin-bottom:-3px;" /> <?php echo $row['Screen'] ?> in</td>
</tr>
<tr>
<td style="width: 60px; text-align: center;" colspan="3"><strong>Concession Only:</strong> $<?php echo number_format((float) ($row['ConcPrice']), 2, '.', ''); ?></td>
</tr>
</tbody>
</table>
<b>Included with this machine:</b>
<ul>
 	<li>Ubuntu Linux 16.04 (Computerbank Edition)</li>
 	<li>Laptop Care Guide</li>
 	<li>Tested Power Adapter</li>
 	<li><a href="/about-us/our-computers/">3 Month warranty</a></li>
 	<li><a href="/about-us/our-computers/">User Guide</a></li>
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

<?php
$sldata = ob_get_clean();

$updatePost = array(
    'ID' => 1880, // wordpress Id
    'post_title' => 'In-Store Stocklist', // Updated title
    'post_content' => $sldata, // Updated content
    'post_type' => 'page',
    'post_status' => 'publish',
    'post_author' => 1,
);

$updateStocklist = wp_update_post($updatePost);

if (is_wp_error($updateStocklist, true)) {
    print("Error");
} else {
    print("Success");
}

?>
