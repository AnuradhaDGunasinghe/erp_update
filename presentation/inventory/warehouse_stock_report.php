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

if (($role_id == 1 && $department == 11) || ($role_id == 4 && $department == 2) || ($role_id == 2 && $department == 18) ||
    ($role_id == 10 && $department == 2) || ($role_id == 5 && $department == 5) || ($role_id == 8 && $department == 5)) {

    ?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center"><a href="./warehouse_stock_report.php">
            <i class="fa-solid fa-home fa-2x m-2" style="color: #ced4da;"></i>
        </a>
    </div>
</div>
<?php
$search_value = 'null';
$search_asin = 'null';
    if (isset($_POST['submit'])) {
        $search_value = $_POST['search'];
        $query = "SELECT * , COUNT(inventory_id)as count
        FROM warehouse_information_sheet
        WHERE model LIKE '%$search_value%' AND send_to_production = '0'GROUP BY model,core";
        echo $query;
        $result_search = mysqli_query($connection, $query);

    }
    if (isset($_POST['submit_asin'])) {
        $search_asin = $_POST['search_asin'];
        $search_value='asin';
    }
    ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 grid-margin stretch-card justify-content-center mx-auto mt-2">
            <div class="card mt-3">
                <div class="input-group mb-2 mt-2 d-flex justify-content-between">
                    <form action="#" method="POST">
                        <input class="w-100" style="color:black !important" type="text" id="search" name="search"
                            placeholder=" Search by Model">
                        <button type="submit" name="submit" id="submit"
                            class="btn mb-2 mt-4 btn-primary btn-sm  mx-auto text-center d-none"></button>
                    </form>
                    <form action="#" method="POST">
                        <input class="w-100" style="color:black !important" type="text" id="search" name="search_asin"
                            placeholder=" Search by ASIN">
                        <button type="submit" name="submit_asin" id="submit"
                            class="btn mb-2 mt-4 btn-primary btn-sm  mx-auto text-center d-none"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if ($search_value == 'null') {
        ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 grid-margin stretch-card justify-content-center mx-auto mt-2">
            <?php if ($department == 5 || $department == 11) {?>
            <a href="all_stock_report_excel.php" class="btn btn-sm btn-success">Download excel
                file</a>
            <a href="unit_by_unit.php" class="btn btn-sm btn-success">Download All Unit Excel
                file</a>

            <a href="asin_list_view.php" class="btn btn-sm btn-info"> ASIN List</a>

            <?php }?>
            <!-- <a href="" class="btn btn-sm btn-success">Download Price List</a> -->
            <div class="card mt-3">

                <div class="card-header bg-secondary">
                    <p class="text-uppercase m-0 p-0">Stock Report </p>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Brand</th>
                                <th>In Total</th>
                                <th>In Stock</th>
                                <th>Processing</th>
                                <th>Dispatch</th>
                            </tr>
                        </thead>
                        <tbody class="table-dark">
                            <?php
$brand = null;
        $main_stock = null;
        $in_total = null;
        $in_stock = null;
        $processing = null;
        $dispatch = null;
        $i=0;
        $query = "SELECT *,  COUNT(inventory_id) as main_total FROM `warehouse_information_sheet` GROUP BY brand";
        $result = mysqli_query($connection, $query);
        foreach ($result as $data) {
            $i++;
            $brand = $data['brand'];
            $main_stock = $data['main_total'];
            echo "
                                    <tr>
                                    <td>$i</td>
                                    <td><a  href='model_summery.php?brand=$brand'> $brand</a></td>
                                    <td> $main_stock</td>";
            echo "<td>";
            $query = "SELECT COUNT(inventory_id) as in_stock FROM `warehouse_information_sheet` WHERE brand = '$brand' AND send_to_production = '0'";
            $result = mysqli_query($connection, $query);
            foreach ($result as $data) {
                $in_stock = $data['in_stock'];

            }
            $query = "SELECT COUNT(inventory_id) as processing FROM `warehouse_information_sheet` WHERE brand = '$brand' AND send_to_production = '1'";
            $result = mysqli_query($connection, $query);
            foreach ($result as $data) {
                $processing = $data['processing'];

            }
            $query = "SELECT  COUNT(inventory_id) as dispatch FROM `warehouse_information_sheet` WHERE brand = '$brand' AND dispatch = '1'";
            $result = mysqli_query($connection, $query);
            foreach ($result as $data) {
                $dispatch = $data['dispatch'];

            }
            $processing = $processing - $dispatch;
            echo $in_stock;
            echo "</td>
            <td>$processing</td>
                                    <td>";

            echo $dispatch;
            echo "
                                </tr>";
        }?>

                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
<?php }elseif($search_value =='asin'){ ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-11 grid-margin stretch-card justify-content-center mx-auto mt-2">
            <div class="card">
                <div class="card-body">
                    <table id="" class="table table-bordered table-hover">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
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
                                    <th>&nbsp;</th>
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
                                    $query = "SELECT brand,asin,model,generation,core, COUNT(inventory_id) as in_total FROM `warehouse_information_sheet` WHERE asin='$search_asin' ";
                                    $result = mysqli_query($connection, $query);
                                    foreach ($result as $data) {
                                        $brand = $data['brand'];
                                        $model = $data['model'];
                                        $asin = $data['asin'];
                                        $core = $data['core'];
                                        $generation = $data['generation'];
                                        $in_total = $data['in_total'];
                                        $i++;
                                        $a++;
                                        echo "
                                    <tr class='cell-1' data-toggle='collapse'   >
                                    <td>$i</td>
                                    <td>$asin</td>
                                    <td>$brand</td>
                                    <td>$model</td>
                                    <td>$core</td>
                                    <td>$generation</td>
                                    <td>$in_total</td>
                                    ";
                                    echo "<td>";
                                    $query = "SELECT COUNT(inventory_id)as in_stock FROM `warehouse_information_sheet` WHERE  asin='$asin' AND send_to_production='0'";

                                    $result = mysqli_query($connection, $query);
                                    foreach ($result as $data) {
                                        $in_stock = $data['in_stock'];

                                    }
                                    $query = "SELECT COUNT(inventory_id)as dispatch FROM `warehouse_information_sheet` WHERE  asin='$asin' AND send_to_production='1' AND dispatch='1'";
                                    $result = mysqli_query($connection, $query);
                                    foreach ($result as $data) {
                                        $dispatch = $data['dispatch'];
                                    }
                                    $available = $in_stock - $dispatch;
                                    echo $in_stock;
                                    echo "</td><td>";
                                    $query = "SELECT COUNT(inventory_id)as processing FROM `warehouse_information_sheet` WHERE  asin='$asin' AND send_to_production='1' AND dispatch='0'";
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
                                                                            FROM `warehouse_information_sheet` WHERE   asin='$asin' AND send_to_production='0' AND touch_or_non_touch='yes'";

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

                                    $query = "SELECT touch_wholesale_price, COUNT(battery)as battery FROM `warehouse_information_sheet` WHERE  asin='$asin' AND send_to_production='0' AND battery='no'";
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
                                ?>
                                <?php }?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
} else {?>
<table id="example2" class="table table-bordered table-striped">
    <table id="tblexportData" class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Device</th>
                <th>Brand</th>
                <th>Series</th>
                <th>Model</th>
                <th>Processor</th>
                <th>CPU</th>
                <th>Generation</th>
                <th>Speed</th>
                <th>Screen Size</th>
                <th>Screen Type</th>
                <th>Optical</th>
                <th>RAM</th>
                <th>HDD</th>
                <th>QTY</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            <?php
$i = 0;
        foreach ($result_search as $data) {
            $device = $data['device'];
            $brand = $data['brand'];
            $series = $data['series'];
            $model = $data['model'];
            $cpu = $data['core'];
            $generation = $data['generation'];
            $speed = $data['speed'];
            $screen_size = $data['lcd_size'];
            $screen_type = $data['touch_or_non_touch'];
            $location = $data['location'];
            $series = $data['series'];
            $optical = $data['dvd'];
            $processor = $data['processor'];
            $location = $data['location'];
            $inventory_id = $data['inventory_id'];
            $count = $data['count'];
            $ram = "8 GB";
            $hdd_capacity = "256 GB";
            $i++;?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $device ?></td>
                <td><?php echo $brand ?></td>
                <td><?php echo $series ?></td>

                <td> <a
                        href="./spec_view_by_core.php?brand=<?php echo $brand; ?>&model=<?php echo $model ?>&core=<?php echo $cpu ?>"><?php echo $model ?></a>
                </td>

                <td><?php echo $processor ?></td>
                <td><?php echo $cpu ?></td>
                <td><?php echo $generation ?></td>
                <td><?php echo $speed ?></td>
                <td><?php echo $screen_size ?></td>
                <td><?php echo $screen_type ?></td>
                <td><?php echo $optical ?></td>
                <td><?php echo $ram ?></td>
                <td><?php echo $hdd_capacity ?></td>
                <td><?php echo $count ?></td>
                <td><?php echo $location ?></td>
            </tr>
            <?php }?>

        </tbody>
    </table>
    <?php }?>

    <style>
    .modal-header {
        display: block;
    }

    .modal-content {
        margin-top: 8rem;
    }
    </style>
    <script>
    let searchbar = document.querySelector('input[name="search"]');
    searchbar.focus();
    search.value = '';
    </script>
    <?php include_once '../includes/footer.php';} else {
    die(access_denied());
}?>