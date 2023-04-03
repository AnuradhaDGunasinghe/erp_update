<!DOCTYPE html>
<html>
<?php
ob_start();
session_start();
include_once('../../dataAccess/connection.php');
include_once('../../dataAccess/functions.php');
include_once('../../dataAccess/403.php');
include_once('../includes/header.php');
require_once "phpqrcode/qrlib.php";
require_once "sanitizer.php";
// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
}

$role_id = $_SESSION['role_id'];
$department = $_SESSION['department'];
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
$start_print=0;
if($role_id == 1 && $department == 11 || $role_id == 4 && $department == 2 || $role_id == 2 && $department == 18){
    
}
$start=0;
$asin=0;
if (isset($_POST['submit'])) {
    $start=1;
        $device = $_POST["device"];
        $mfg = $_POST["mfg"];
        $brand = $_POST["brand"];
        $processor = $_POST["processor"];
        $core = $_POST["core"];
        $generation = $_POST["generation"];
        $model = $_POST["model"];
        $location = $_POST["location"];
        $speed = $_POST["speed"];
        $lcd_size = $_POST["lcd_size"];
        $screen_resolution = $_POST["screen_resolution"];
        $screen_resolution_type= $_POST["screen_resolution_type"];
        $battery = $_POST["battery"];
        $touch_or_non_touch = $_POST["touch_or_non_touch"];
        $dvd = $_POST["dvd"];
        $kb = $_POST["kb"];
        $asin = $_POST["asin"];
        $screen_resolution_type = $_POST["screen_resolution_type"];
        $comment = $_POST["comment"];

        // $sql = strtolower("UPDATE `warehouse_information_sheet` 
        // SET
        //         brand ='$brand',
        //         processor ='$processor',
        //         core ='$core',
        //         generation ='$generation',
        //         model ='$model',
        //         location ='$location',
        //         inventory_id ='$inventory_id',
        //         speed ='$speed',
        //         lcd_size ='$lcd_size',
        //         screen_resolution ='$screen_resolution',
        //         screen_resolution_type='$screen_resolution_type',
        //         battery ='$battery',
        //         touch_or_non_touch ='$touch_or_non_touch',
        //         dvd ='$dvd',
        //         keyboard_backlight ='$kb',
        //         asin ='$asin',
        //         comment='$comment',
        //         create_by_inventory_id='$username',
        //         reprint='1'
        //  WHERE `inventory_id` = '{$_POST['inventory_id']}'");
        //             $query1 = mysqli_query($connection, $sql);

                // (A) IMAGE OBJECT
                if($kb==1){
                    $kb='Backlit KB';
                }else{
                    $kb='';
                }
                if($touch_or_non_touch=='yes'){
                    $touch_or_non_touch='Touch';
                }else{
                    $touch_or_non_touch='';
                }
                $ram=0;
                $hdd=0;
                $query = "SELECT ram,hard_disk_capacity FROM `asin_details` WHERE `asin_no`='$asin';";
                $query1 = mysqli_query($connection, $query);
                foreach($query1 as $abc){
                    $ram=strToUpper($abc['ram']);
                    $hdd=strToUpper($abc['hard_disk_capacity']);
                }
                 $sql = "INSERT INTO `warehouse_information_sheet`(
            `device`,
            `processor`,
            `core`,
            `generation`,
            `model`,
            `brand`,
            `create_by_inventory_id`,
            `mfg`,
            `speed`,
            `battery`,
            `lcd_size`,
            `touch_or_non_touch`,
             `dvd`,
             screen_resolution,
             location,
             keyboard_backlight,
             asin,
             reprint
        )
        VALUES(
            'Laptop',
            '$processor',
            '$core',
            '$generation',
            '$model',
            '$brand',
            '$user_id',
            '$mfg',
            '$speed',
            '$battery',
            '$lcd_size',
            '$touch_or_non_touch',
            '$dvd',
            '$screen_resolution',
            '$location',
            '$kb',
            '$asin',
            '1'
        )";
         $query_run = mysqli_query($connection, $sql);
                
                     $query = "SELECT *  FROM warehouse_information_sheet ORDER BY `inventory_id` DESC LIMIT 1";
    $query1 = mysqli_query($connection, $query);
    foreach ($query1 as $data) {
        $last_inventory_id = $data['inventory_id'];
    }
    $tempDir = 'temp/';
    $filename = $last_inventory_id;
    $codeContents = $last_inventory_id;

    QRcode::png($codeContents, $tempDir . '' . $filename . '.png', QR_ECLEVEL_L, 5, 1);
              
                ///////////////////////////////////////////////////////////////////////
                
                    $im = imagecreatetruecolor(400, 200);

                    // Create some colors
                    $white = imagecolorallocate($im, 255, 255, 255);
                    $black = imagecolorallocate($im, 0, 0, 0);
                    imagefilledrectangle($im, 0, 0, 400, 200, $white);
                    
                    // Replace path by your own font path
                     $font = '../../static/dist/fonts/Poppins-ExtraBold.ttf';

                    // Add some shadow to the text
                    
                    
                /////////////////////////////////////////////////////////////////////////
                $brand=strToUpper($brand);
                $model=strToUpper($model);
                $asin=strToUpper($asin);
                if( $touch_or_non_touch =='yes'){
                     $touch_or_non_touch="Touch";
                }else{
                     $touch_or_non_touch='';
                }
                ///////////////////////////////////////////

                    // Add the text
                    imagettftext($im, 15, 0, 10, 15, $black, $font, "$brand    $model" );
                    imagettftext($im, 15, 0, 10, 35, $black, $font, "$core $speed $screen_resolution_type $touch_or_non_touch $kb");
                    if($ram !=0 && $hdd !=0){
                    imagettftext($im, 15, 0, 150, 80, $black, $font, "$ram GB / $hdd GB");
                    }
                    imagettftext($im, 15, 0, 10, 175, $black, $font, "ALSAKB $last_inventory_id");
                    imagettftext($im, 15, 0, 10, 195, $black, $font, "WH2-$generation-$model");
                    
                    // Output to browser
                    header('Content-Type: image/png');
                    

                    imagepng($im, "files/$username test.png");
                    imagedestroy($im);
                //////////////////////////////////////////////////////////////////////////
                
                    ///////////////////////////////////////////////////////////////////////////////////////////
                      $img = imagecreatetruecolor(40, 200);

                    // Create some colors
                    $white = imagecolorallocate($im, 255, 255, 255);
                    $black = imagecolorallocate($im, 0, 0, 0);
                    imagefilledrectangle($img, 0, 0, 40, 200, $white);
                    
                    // Replace path by your own font path

                      $font = '../../static/dist/fonts/Poppins-ExtraBold.ttf';

                    // Add some shadow to the text

                    // Add the text
                    
                    imagettftext($img, 15, 90, 20, 180, $black, $font, "$asin" );
                    
                    // Output to browser
                    header('Content-Type: image/png');
                    

                    imagepng($img, "asin/$username asin.png");
                    imagedestroy($img);
                    //////////////////////////////////////////////////////////////////////////////////////////
                    $dest = imagecreatefrompng(
                "files/$username test.png");
                $src = imagecreatefrompng(
                "temp/$last_inventory_id.png");
                 $src2 = imagecreatefrompng(
                "asin/$username asin.png");
                 
                // Copy and merge
                imagecopymerge($dest, $src, 15, 40, 0, 0, 110, 110, 75);
                imagecopymerge($dest, $src2, 380, 0, 0, 0, 30, 200, 75);
                
                // Output and free from memory
                header('Content-Type: image/png');
                imagegif($dest,"files/$username sticker.png");
                ///////////////////////////////////////////////////////////////////////////////////////////
                    $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                    $start_date = $date1->format('Y-m-d H:i:s');
                     $query = " INSERT INTO `performance_record_table`(
                    `user_id`,
                    `department_id`,
                    `qr_number`,
                    `job_description`,
                    `start_time`,
                    `end_time`,
                    status
                    )
                    VALUES(
                    '$user_id',
                    '$department_id',
                    '$inventory_id',
                    'PC Scaned',
                    '$start_date',
                    '$start_date',
                    '1'
                    ) ";
                    $query_run = mysqli_query($connection, $query);
                //////////////////////////////////////////////////////////////////////////////////////////
                 header("Location: testimg2.php");
}

?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>
    var brand = 0;
    var series = 0;
    var model = 0;
    var processor = 0;
    var core = 0;
    var generation = 0;

    $(document).ready(function() {
        $("#device").on("change", function() {
            var device = $("#device").val();

            var getURL = "ajax.php?device=" + device;
            $.get(getURL, function(data, status) {
                $("#brand").html(data);
            });
        });
    });

    $(document).ready(function() {
        $("#brand").on("change", function() {
            brand = $("#brand").val();
            var getURL = "ajax.php?brand=" + brand;
            console.log(device);
            $.get(getURL, function(data, status) {
                $("#model").html(data);
            });
        });
    });

    $(document).ready(function() {
        $("#model").on("change", function() {
            model = $("#model").val();
            var getURL = "ajax.php?model=" + model + "&brand1=" + brand;
            $.get(getURL, function(data, status) {
                $("#processor").html(data);
            });
        });
    });

    $(document).ready(function() {
        $("#processor").on("change", function() {
            processor = $("#processor").val();
            var getURL = "ajax.php?processor=" + processor + "&model1=" + model +
                "&brand1=" +
                brand;
            $.get(getURL, function(data, status) {
                $("#core").html(data);
            });
        });
    });

    $(document).ready(function() {
        $("#core").on("change", function() {
            core = $("#core").val();
            var getURL = "ajax.php?core=" + core + "&processor1=" + processor + "&model1=" +
                model +
                "&brand1=" + brand;
            $.get(getURL, function(data, status) {
                $("#generation").html(data);
            });
        });
    });

    $(document).ready(function() {
        $("#generation").on("change", function() {
            generation = $("#generation").val();
            console.log(generation);
            var getURL = "ajax.php?generation=" + generation + "&core1=" + core +
                "&processor1=" +
                processor + "&model1=" + model + "&brand1=" + brand;

            $.get(getURL, function(data, status) {
                $("#speed").html(data);
            });
        });
    });

    $(document).ready(function() {
        $("#speed").on("change", function() {
            var speed = $("#speed").val();
            var getURL = "ajax.php?speed=" + speed + "&model1=" + model + "&brand1=" +
                brand;
            $.get(getURL, function(data, status) {
                $("#lcd_size").html(data);
            });
        });
    });

    $(document).ready(function() {
        $("#lcd_size").on("change", function() {
            var lcd_size = $("#lcd_size").val();
            var getURL = "ajax.php?lcd_size=" + lcd_size + "&model1=" + model + "&brand1=" +
                brand;
            $.get(getURL, function(data, status) {
                $("#screen_resolution").html(data);
            });
        });
    });
    $(document).ready(function() {
        $("#core").on("change", function() {
            var getURL = "get_asin.php?brand=" + brand + "&model=" + model + "&core=" + core;

            $.get(getURL, function(data, status) {
                $("#asin").html(data);
            });
        });
    });
    $(document).ready(function() {
        $("#asin").on("change", function() {
            asin = $("#asin").val();
            var getURL = "get_asin.php?asin=" + asin;

            $.get(getURL, function(data, status) {
                $("#note").html(data);
            });
        });
    });
    </script>

</head>

<body>


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 grid-margin stretch-card justify-content-center mx-auto mt-2">
                <div class="card mt-3">
                    <div class="card-header bg-secondary">
                        <p class="text-uppercase m-0 p-0">Update Inventory ID</p>
                    </div>
                    <div class="card-body">

                        <form method="POST">
                            <fieldset>
                                <legend>Update Warehouse Information Sheet</legend>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">MFG</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="mfg" name="mfg" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Device</label>
                                    <div class="col-sm-8">
                                        <select class="w-100" name="device" id="device" style="border-radius: 5px;"
                                            required>
                                            <option selected>
                                            </option>
                                            <option value="Laptop?>"><?php echo "Laptop"; ?>
                                            </option>

                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Brand</label>
                                    <div class="col-sm-8">
                                        <select class="w-100" name="brand" id="brand" style="border-radius: 5px;"
                                            required>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Model</label>
                                    <div class="col-sm-8 w-100">
                                        <select class="w-100" name="model" id="model" style="border-radius: 5px;"
                                            required>

                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Processor</label>
                                    <div class="col-sm-8">
                                        <select class="w-100" name="processor" id="processor"
                                            style="border-radius: 5px;" required>

                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Core</label>
                                    <div class="col-sm-8">
                                        <select class="w-100" name="core" id="core" style="border-radius: 5px;"
                                            required>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Generation</label>
                                    <div class="col-sm-8">
                                        <select class="w-100" name="generation" id="generation"
                                            style="border-radius: 5px;" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Speed</label>
                                    <div class="col-sm-8 w-100">
                                        <select class="w-100" name="speed" id="speed" style="border-radius: 5px;"
                                            required>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label">LCD Size</label>
                                    <div class="col-sm-8 w-100">
                                        <select class="w-100" name="lcd_size" id="lcd_size" style="border-radius: 5px;"
                                            required>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Screen Resolution</label>
                                    <div class="col-sm-8 w-100">
                                        <select class="w-100" name="screen_resolution" id="screen_resolution"
                                            style="border-radius: 5px;" required>

                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Screen Resolution Type</label>
                                    <div class="col-sm-8 w-100">
                                        <select class="w-100" name="screen_resolution_type" id="screen_resolution_type"
                                            style="border-radius: 5px;" required>
                                            <option value='SXGA'>SXGA </option>
                                            <option value='HD'>HD </option>
                                            <option value='FHD'> FHD</option>
                                            <option value='WUXGA'> WUXGA</option>
                                            <option value='QHD'>QHD </option>
                                            <option value='WQHD'>WQHD </option>
                                            <option value='UHD'>UHD </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Screen Type (TOUCH / NONE TOUCH)</label>
                                    <div class="col-sm-8 w-100">
                                        <select class="w-100" name="touch_or_non_touch" id="touch_or_non_touch"
                                            style="border-radius: 5px;" required>
                                            <option selected value="1">YES</option>
                                            <option selected value="0">No</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Battery</label>
                                    <div class="col-sm-8 w-100">
                                        <select class="w-100" name="battery" style="border-radius: 5px;" required>
                                            <option selected value="1">YES</option>
                                            <option selected value="0">No</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Optical</label>
                                    <div class="col-sm-8 w-100">
                                        <select class="w-100" name="dvd" style="border-radius: 5px;" required>
                                            <option selected value="1">YES</option>
                                            <option selected value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Keyboard Backlight</label>
                                    <div class="col-sm-8 w-100">
                                        <select class="w-100" name="kb" style="border-radius: 5px;" required>
                                            <option selected></option>
                                            <option value='1'>YES</option>
                                            <option value='0'>NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">ASIN</label>
                                    <div class="col-sm-8 w-100">
                                        <select class="w-100" name="asin" id="asin" style="border-radius: 5px;">
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">ASIN Description</label>
                                    <div class="col-sm-8">
                                        <p id="note"></p>

                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Location</label>
                                    <div class="col-sm-8">
                                        <select class="w-100" name="location" style="border-radius: 5px;" required>
                                            <option value="WH2">WH2</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Comment</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="comment" class="w-100">
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
        </div>
    </div>
</body>

</html>