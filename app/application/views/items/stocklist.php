<?php $this->load->view('partial/header');?>

<?php

// machine count
$desktopCt = 0;
$laptopCt = 0;

foreach ($stocklist as $computer) {
    if ($computer->category == 'Desktop') {
        $desktopCt += 1;
    } elseif ($computer->category == 'Laptop') {
        $laptopCt += 1;
    }
}
?>


<style>
    td {
        padding: 4px !important;
    }

    .printed {
        font-size: 14px;
        vertical-align: middle;
    }

    .print-show {
        display: none;
    }

    img.logo {
        width: 225px;
        float: right;
        margin-bottom: 25px;
        display: none;
    }

    .modal-header {
        background-color: #0f007d;
        color: #fff;
        font-size: 16px;
    }

    .modal-body h3 {
        margin-top: 0px;
    }

    @media print {
        .container {
            width: 100% !important;
         }
         body {
            height: auto;
        }
        @page {
            size: landscape
        }
        table.table.table-sm.table-bordered {
            font-size: 12px;
        }
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        .print-show {
            display: inline;
        }
        img.logo {
            display: inherit;
        }
        h3 {
            padding-top: 40px;
        }
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
                    <p>To ensure the stock list is printed correctly, please ensure the printer settings in the popup dialog are configured as follows:</p>
                </div>
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
                        <tr>
                            <th scope="row">Headers/Footers</th>
                            <td colspan="2">Off</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="printdoc();" class="btn btn-primary">Print Stocklist</button>
            </div>
        </div>
    </div>
</div>

<div id="title_bar" class="btn-toolbar print_hide">

<button data-toggle="modal" data-target="#printWarning" class="btn btn-info btn-sm pull-right">
    <span class="glyphicon glyphicon-print">&nbsp</span>Print Stocklist
</button>

<button class='btn btn-info btn-sm pull-right' onclick="window.location.href='/items/'">
    <span class="glyphicon glyphicon-tag">&nbsp</span>Back to Items
</button>
</div>

<?php echo ($desktopCt == 0) ? 'No Desktops on Stocklist' : '' ?>

    <div class="desktop-stocklist"<?php echo ($desktopCt == 0) ? ' style="display:none;"' : '' ?>>

        <img src="<?php echo base_url('uploads/' . $this->config->item('company_logo')); ?>" class="logo" />

        <h3>Desktops <span class="printed print-show">- Printed on <?php echo date('D d/m/y'); ?></span></h3>
        <p class="print_hide">The listed concession price is only available to concession card holders. Please have a valid concession card ready when you make your purchase. You may purchase a desktop computer without a concession card, but you will be charged our market price, as shown below.</p>

        <table class="table table-sm table-bordered table-striped">
            <thead class="thead-light">
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
                    <th>System</th>
                </tr>
            </thead>
            <tbody>

<?php
foreach ($stocklist as $computer) {
    if (($computer->category) == 'Desktop') {
        ?>
    <tr>
        <td><?php echo $computer->name; ?></td>
        <td><?php echo ($computer->custom10) ? $computer->custom10 : 'Tower'; // type?></td>
        <td>$<?php echo number_format((float) ($computer->unit_price), 2, '.', ''); ?></td>
        <td>$<?php echo number_format((float) ($computer->unit_price) * 1.5, 2, '.', ''); ?></td>
        <td><?php echo $computer->custom2; //brand/model?></td>
        <td><?php echo $computer->custom3; // cpu type?></td>
        <td><?php echo $computer->custom4; // cpu speed?> Ghz</td>
        <td><?php echo $computer->custom5; // ram?> GB</td>
        <td><?php echo $computer->custom6; // hdd?></td>
        <td><?php echo $computer->custom8; // screen?>in</td>
        <td><?php echo $computer->custom9; // optical drive?></td>
        <td><?php echo $computer->custom7; // operating system?></td>
    </tr>

<?php
    }
}
?>
    </tbody>
</table>

</div>

<br>
<br>

<?php echo ($laptopCt == 0) ? 'No Laptops on Stocklist' : '' ?>

<div class="pagebreak laptop-stocklist"<?php echo ($laptopCt === 0) ? ' style="display:none;"' : '' ?>>

    <img src="<?php echo base_url('uploads/' . $this->config->item('company_logo')); ?>" class="logo" />

    <h3>Laptops <span class="printed print-show">- Printed on <?php echo date('D d/m/y'); ?></span></h3>
    <p class="print_hide">Laptops are first come, first served. You must have a valid concession card to purchase a laptop. Strictly one laptop per customer.</p>

    <table class="table table-sm table-bordered table-striped">

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
                <th>System</th>
            </tr>
        </thead>
        <tbody>
<?php
foreach ($stocklist as $computer) {
    if (($computer->category) == "Laptop") {
        ?>

    <tr>
        <td><?php echo $computer->name; ?></td>
        <td>$<?php echo number_format((float) ($computer->unit_price), 2, '.', ''); ?></td>
        <td><?php echo $computer->custom2; //brand/model?></td>
        <td><?php echo $computer->custom3; // cpu type?></td>
        <td><?php echo $computer->custom4; // cpu speed?> Ghz</td>
        <td><?php echo $computer->custom5; // ram?> GB</td>
        <td><?php echo $computer->custom6; // hdd?></td>
        <td><?php echo $computer->custom8; // screen?>in</td>
        <td><?php echo $computer->custom9 // optical drive?></td>
        <td><?php echo $computer->custom11; // battery life?> hrs</td>
        <td><?php echo $computer->custom7; // operating system?></td>
    </tr>

    <?php
    }
}
?>

    </tbody>
</table>

</div>

<br><br>

<?php $this->load->view('partial/footer');?>
