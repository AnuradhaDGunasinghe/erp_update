<?php 
ob_start();
session_start();
include_once('../../dataAccess/connection.php');
include_once('../../dataAccess/functions.php');
include_once('../../dataAccess/403.php');
include_once('../includes/header.php');
require_once("sanitizer.php");
// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
}

$role_id = $_SESSION['role_id'];
$department = $_SESSION['department'];
$username = $_SESSION['username'];
$start_print=0;
if($role_id == 1 && $department == 11 || $role_id == 4 && $department == 2 || $role_id == 2 && $department == 18){
    
    $device ="scan qr first";
    $brand="scan qr first";
    $processor ="scan qr first";
    $core ="scan qr first";
    $generation ="scan qr first";
    $model ="scan qr first";
    $location ="scan qr first";
    $inventory_number ="scan qr first";
    $inventory_id;
if (isset($_POST['search'])) {

    $inventory_id = $_POST['search'];
    $query = "SELECT `inventory_id`, `device`, `processor`, `core`, `generation`, `model`, `location`, `brand`, `create_by_inventory_id`FROM `warehouse_information_sheet` WHERE `inventory_id`='$inventory_id';";
    $query1 = mysqli_query($connection, $query);
    foreach ($query1 as $data) {
        $device =$data['device'];
        $brand =$data['brand'];
        $processor =$data['processor'];
        $core =$data['core'];
        $generation =$data['generation'];
        $model =$data['model'];
        $location =$data['location'];
       
    }

}

if (isset($_POST['submit'])) {
        $device = $_POST["device"];
        $brand = $_POST["brand"];
        $processor = $_POST["processor"];
        $core = $_POST["core"];
        $generation = $_POST["generation"];
        $model = $_POST["model"];
        $location = $_POST["location"];
        $inventory_number = $_POST["inventory_id"];
        $sql = strtolower("UPDATE `warehouse_information_sheet` SET`location`='$location',`create_by_inventory_id`='$username' WHERE `inventory_id` = '{$_POST['inventory_id']}'");
                 
                    $query1 = mysqli_query($connection, $sql);
                //    header('Location: warehouse_qr_report.php');
                echo '<script type="text/javascript">';
                echo 'alert("Success");';
                echo 'window.location.href = "warehouse_qr_report.php";';
                echo '</script>';
}
?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center d-flex">
        <a href="./warehouse_dashboard.php">
            <i class="fa-solid fa-home fa-2x m-2" style="color: #ced4da;"></i>
        </a>
        <h3 class="mt-2">Update QR Codes</h3>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card justify-content-center mx-auto mt-2">
            <div class="card mt-3">
                <div class="card-header bg-secondary">
                    <p class="text-uppercase m-0 p-0">Update Inventory ID</p>
                </div>
                <div class="card-body">

                    <fieldset class="mt-2 mb-2">
                        <legend>Scan QR</legend>

                        <form action="#" method="POST">
                            <div class="input-group mb-2 mt-2">
                                <input type="text" id="search" name="search" required value="<?php if (isset($_POST['search'])) {
                                                                                        echo $_POST['search'];
                                                                                    } ?>" placeholder="Search QR">
                            </div>

                        </form>
                    </fieldset>

                    <form method="POST">
                        <fieldset>
                            <legend>Update Warehouse Information Sheet</legend>

                            <div class="row">
                                <label class="col-sm-3 col-form-label">Device</label>
                                <div class="col-sm-8">
                                    <select class="w-100" name="device" style="border-radius: 5px;" required>
                                        <option selected value="<?php echo $device; ?>"><?php echo $device; ?></option>

                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-3 col-form-label">Brand</label>
                                <div class="col-sm-8">
                                    <select class="w-100" name="brand" style="border-radius: 5px;" required>
                                        <option selected><?php echo $brand; ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-3 col-form-label">Processor</label>
                                <div class="col-sm-8">
                                    <select class="w-100" name="processor" style="border-radius: 5px;" required>
                                        <option selected><?php echo $processor; ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-3 col-form-label">Core</label>
                                <div class="col-sm-8">
                                    <select class="w-100" name="core" style="border-radius: 5px;" required>
                                        <option selected value="<?php echo $core; ?>"><?php echo $core; ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-3 col-form-label">Generation</label>
                                <div class="col-sm-8">
                                    <select class="w-100" name="generation" style="border-radius: 5px;" required>
                                        <option selected><?php echo $generation; ?></option>
                                    </select>
                                </div>
                            </div>


                            <div class="row">
                                <label class="col-sm-3 col-form-label">Model</label>
                                <div class="col-sm-8 w-100">
                                    <input type="text" class="form-control" placeholder="<?php echo $model; ?>"
                                        value="<?php echo $model; ?>" name="model">
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-3 col-form-label">Location</label>
                                <div class="col-sm-8">
                                    <select class="w-100" name="location" style="border-radius: 5px;" required>
                                        <option selected><?php echo $location; ?></option>
                                        <option value="WH2">WH2</option>

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <?php if(!empty($inventory_id) ){ ?>
                                <input class="form-control" type="hidden" name="inventory_id"
                                    value=' <?php echo  $inventory_id; ?>'>
                                <?php } ?>

                            </div>

                            <div class="d-flex col-5 mx-auto">

                                <button type="submit" name="submit" id="submit"
                                    class="btn mb-2 mt-4 bg-gradient-primary btn-sm d-block mx-auto text-center"><i
                                        class="fa-solid fa-qrcode" style="margin-right: 5px;"></i>Update QR
                                </button>
                            </div>

                        </fieldset>

                    </form>


                </div>
            </div>
        </div>
        <!-- <div class="col-lg-6 grid-margin stretch-card justify-content-center mx-auto mt-2 d-none">
            <div class="card mt-3 w-100">
                <div class="card-body">

                    <input type="button" onclick="printDiv('printableArea')" value="print a QR!" />
                    <?php if($start_print == 1|| $inventory_number !=0){ ?>
                    <div id="printableArea">
                        <?php }else{ ?>
                        <div>
                            <?php }
                            $series='';
                            $speed='';
                            $query = "SELECT * FROM warehouse_information_sheet WHERE inventory_id='$inventory_number' ";
                            $query1 = mysqli_query($connection, $query);
                            foreach ($query1 as $data) {
                                $brand =$data['brand'];
                                $model =$data['model'];
                                $core =$data['core'];
                                $generation =$data['generation'];
                                $model =$data['model'];
                                $series =$data['series'];
                                $speed =$data['speed'];
                                $location =$data['location'];
                               
                            }
                    $inventory_id =0;
                    $quantity = 1;
                        $howManyCodes =1;
                        $digits = 6;
                        $start = $inventory_number; 
                        $overText = $brand."  ".$series." ".$model ;
                        $secondPart = $core." ".$speed;
                        $downText = $generation."-".$model;
                            $rack=$location;
                        $hideText = null;

                        if($start_print == 1|| $inventory_number !=0){
                          
                    $codeArray = (filterRaw('codeArray') != "") ? filterRaw('codeArray') : "";
                    function write($code,$overText, $rack, $downText,$secondPart) {
                        ?>
                            <table>
                                <tr>
                                    <th style="width :600mm"><?php if ($overText != "") {
                                $abc= strtoupper( $overText);
                                echo  "<div   ><p class = 'text-uppercase' style='font-size: 70;
                                font-family: Arial, Helvetica, sans-serif;margin: 30px 0 0 0;
                                color:black;text-weight:bold;text-align: left;margin:0'>$abc <br> $secondPart</p></div>";
                            } 
                            ?>
                                    <th>
                                </tr>
                                <tr>
                                    <th style="width :400px">
                                        <div style="display:flex">
                                            <?php echo '<img src="temp/'.$code.'.png" style="width:350px; height:350px;margin: 0px 0 0 25px;">';?>
                                            <?php 
                                $text = $rack."-".$downText;
                            echo strtoupper("<div style = 'font-family: Arial, Helvetica, sans-serif; margin: 225px 0 0 20px; font-size: 60px; color:black;text-weight:bold;'>$text </div></br> ");
                            
                            ?>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th> <?php 
                            echo strtoupper("<div style = 'font-family: Arial, Helvetica, sans-serif; margin: 0px 100px 0 0px; font-size: 60px; color:black;text-weight:bold;'>ALSAKB$code</div></br> ");
                            
                            ?></th>
                                </tr>


                            </table>

                            <?php
                                            }
                                        echo "<div class='sheet'>";
                            if ($codeArray != "") { // Specified array of codes
                                foreach (json_decode($codeArray) as $secondPart) {
                                    write($code, $overText, $rack,  $downText,$secondPart);
                                }
                            } else { // Unspecified codes, let's go incremental
                                for ($i = $start; $i < $howManyCodes + $start; $i++) {
                                    $code = str_pad($i, $digits, "0", STR_PAD_LEFT);
                                    write($code, $overText, $rack,  $downText,$secondPart);
                                }
                            }
                        echo "</div>";
                        
                          } 
                          ?>

                        </div>
                    </div>
                </div>

            </div>
        </div> -->
    </div>
</div>


<!-- <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->

<script>

</script>
<style>
textarea {
    text-transform: uppercase;
}

select,
input[type="text"],
[type="number"],
[type="email"],
[type='date'] {
    height: 22px;
    margin: inherit;
    margin-top: 4px;
    font-size: 10px;
    text-transform: uppercase;
    border: 1px solid #f1f1f1;
    border-radius: 5px;
    font-size: 12px;
}

.custom-select {
    font-size: 12px;
}

#exampleFormControlTextarea1 {
    font-size: 12px;
}
</style>

<script>
setTimeout(function() {
    if ($('#msg').length > 0) {
        $('#msg').remove();
    }
}, 10000)
</script>
<script>
let searchbar = document.querySelector('input[name="search"]');
searchbar.focus();
search.value = '';
</script>

<style>
@media screen and (orientation: landscape) {
    .toolbar {
        position: fixed;
        width: 2.65em;
        height: 100%;
    }

    .sheet {
        box-sizing: border-box;
        background-color: #FFF;
        height: 25.00mm;
        width: 50.00mm;
        overflow: hidden;
    }
</style>


<?php include_once('../includes/footer.php'); }else{
        die(access_denied());
} ?>