<?php
session_start();
include_once '../../dataAccess/connection.php';
include_once '../../dataAccess/functions.php';
include_once '../../dataAccess/403.php';
include_once '../includes/header.php';

// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
}

$role_id = $_SESSION['role_id'];
$department = $_SESSION['department'];

?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <a href="./warehouse_stock_report.php">
            <i class="fa-solid fa-left fa-2x m-2" style="color: #ced4da;"></i>
        </a>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-11 grid-margin stretch-card justify-content-center mx-auto mt-2">
            <div class="card">

                <div class="card-body">
                    <button onclick="exportToExcel('tblexportData', '<?php echo 'ASIN-List-STOCK';?>')"
                        class="btn bg-gradient-success mt-3">Export Table Data To Excel
                        File</button>
                    <table class="table table-bordered table-hover">
                        <table id="tblexportData" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ASIN</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>core</th>
                                    <th>Generation</th>
                                    <th>In Total</th>
                                    <th>In Stock</th>
                                    <th>Processing</th>
                                    <th>Dispatch</th>
                                    <th>Touch Screen Count</th>
                                    <th>Non Touch Count</th>
                                    <th>Touch Wholesale Price</th>
                                    <th>Non Touch Wholesale Price</th>
                                    <th>No Battery Count</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">

                                <?php
                                    // $model = null;
                                    $in_total = null;
                                    $in_stock = null;
                                    $dispatch = null;
                                    $main_stock = null;
                                    $i = 0;
                                    $a = 0;
                                    $touch_wholesale_price = 0;
                                    $non_touch_wholesale_price = 0;
                                    $query = "SELECT brand,asin,model,generation,core, COUNT(inventory_id) as in_total FROM `warehouse_information_sheet` GROUP BY asin";
                                    $result = mysqli_query($connection, $query);
                                    foreach ($result as $data) {
                                        $brand = $data['brand'];
                                        $model = $data['model'];
                                        $asin = $data['asin'];
                                        $core = $data['core'];
                                        $generation = $data['generation'];
                                        $in_total = $data['in_total'];
                                        $a++;
                                        if($asin == ''){}else{
                                        echo "
                                    <tr class='cell-1' data-toggle='collapse'   >
                                    <td>".++$i."</td>
                                    <td>$asin</td>
                                    <td>$brand</td>
                                    <td>$model</td>
                                    <td>$core</td>
                                    <td>$generation</td>
                                    <td>$in_total</td>
                                    ";
                                    echo "<td>";
                                    $query = "SELECT COUNT(inventory_id)as in_stock FROM `warehouse_information_sheet` WHERE asin = '$asin' AND model='$model'AND core='$core' AND send_to_production='0'";

                                    $result = mysqli_query($connection, $query);
                                    foreach ($result as $data) {
                                        $in_stock = $data['in_stock'];

                                    }
                                    $query = "SELECT COUNT(inventory_id)as dispatch FROM `warehouse_information_sheet` WHERE asin = '$asin' AND brand = '$brand' AND model='$model'AND core='$core' AND send_to_production='1' AND dispatch='1'";
                                    $result = mysqli_query($connection, $query);
                                    foreach ($result as $data) {
                                        $dispatch = $data['dispatch'];
                                    }
                                    $available = $in_stock - $dispatch;
                                    echo $in_stock;
                                    echo "</td><td>";
                                    $query = "SELECT COUNT(inventory_id)as processing FROM `warehouse_information_sheet` WHERE asin = '$asin' AND brand = '$brand' AND model='$model'AND core='$core' AND send_to_production='1' AND dispatch='0'";
                                    $result = mysqli_query($connection, $query);
                                    foreach ($result as $data) {
                                    echo $data['processing'];
                                    }
                                    echo "</td>
                                                                    <td>";

                                    echo $dispatch;
                                    echo "
                                                                    </td>";
                                    echo "<td>";
                                    $query = "SELECT non_touch_wholesale_price, COUNT(touch_or_non_touch)as touch_or_non_touch
                                                                            FROM `warehouse_information_sheet` WHERE asin = '$asin' AND brand = '$brand' AND model='$model'AND core='$core' AND send_to_production='0' AND touch_or_non_touch='yes'";

                                    $result = mysqli_query($connection, $query);
                                    foreach ($result as $data) {
                                        $touch_or_non_touch = $data['touch_or_non_touch'];
                                        $non_touch_wholesale_price = $data['non_touch_wholesale_price'];

                                    }
                                    echo $touch_or_non_touch;
                                    echo "</td>";
                                    $no_touch = $in_stock - $touch_or_non_touch;
                                    echo "<td>" . $no_touch . "</td>";
                                    echo "<td>" . $non_touch_wholesale_price . "</td>";

                                    $query = "SELECT touch_wholesale_price, COUNT(battery)as battery FROM `warehouse_information_sheet` WHERE asin = '$asin' AND brand = '$brand' AND model='$model'AND core='$core' AND send_to_production='0' AND battery='no'";
                                    $result = mysqli_query($connection, $query);
                                    foreach ($result as $data) {
                                        $battery = $data['battery'];
                                        $touch_wholesale_price = $data['touch_wholesale_price'];

                                    }
                                    echo "<td>$touch_wholesale_price </td>";
                                    echo "<td>$battery </td>";
                                    echo "</td>";

                                    echo "
                                                                </tr>";
                                }
                                ?>
                                <?php }?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>



<style>
.modal-header {
    display: block;
}

.modal-content {
    margin-top: 8rem;
}


.cell-1 {
    border-collapse: separate;
    border-spacing: 0 4em;
    background: #ffffff;
    border-bottom: 5px solid transparent;
    /*background-color: gold;*/
    background-clip: padding-box;
    cursor: pointer;

}

.table-elipse {
    cursor: pointer;
}

#demo {
    -webkit-transition: all 0.3s ease-in-out;
    -moz-transition: all 0.3s ease-in-out;
    -o-transition: all 0.3s 0.1s ease-in-out;
    transition: all 0.3s ease-in-out;
    width: 100%;
}

.row-child {
    background-color: #000;
    color: #fff;
    width: 400px !important;
}
</style>
<script type="text/javascript">
function exportToExcel(tableID, filename = '') {
    var downloadurl;
    var dataFileType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');

    // Specify file name
    filename = filename ? filename + '.xls' : 'export_excel_data.xls';

    // Create download link element
    downloadurl = document.createElement("a");

    document.body.appendChild(downloadurl);

    if (navigator.msSaveOrOpenBlob) {
        var blob = new Blob(['\ufeff', tableHTMLData], {
            type: dataFileType
        });
        navigator.msSaveOrOpenBlob(blob, filename);
    } else {
        // Create a link to the file
        downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;

        // Setting the file name
        downloadurl.download = filename;

        //triggering the function
        downloadurl.click();
    }
}


/////////////////////////////////////////////////////
function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("tblexportData");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>

<?php include_once '../includes/footer.php';?>