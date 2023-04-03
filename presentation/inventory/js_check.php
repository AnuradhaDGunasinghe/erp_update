<!DOCTYPE html>
<html>
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
    $speed ="scan qr first";
    $lcd_size ="scan qr first";
    $screen_resolution ="scan qr first";
    $screen_resolution_type="scan qr first";
    $battery ="scan qr first";
    $touch_or_non_touch ="scan qr first";
    $dvd ="scan qr first";
}
if (isset($_POST['search'])) {

    $inventory_id = $_POST['search'];
    $query = "SELECT `inventory_id`, `device`,model ,`processor`, `core`, `generation`, `location`, `brand`,speed,lcd_size,screen_resolution,battery,touch_or_non_touch,dvd FROM `warehouse_information_sheet` WHERE `inventory_id`='$inventory_id';";
    $query1 = mysqli_query($connection, $query);
    foreach ($query1 as $data) {
        $device =$data['device'];
        $brand =$data['brand'];
        $processor =$data['processor'];
        $core =$data['core'];
        $generation =$data['generation'];
        $model =$data['model'];
        $location =$data['location'];
        $speed =$data['speed'];
        $lcd_size =$data['lcd_size'];
        $screen_resolution =$data['screen_resolution'];
        $battery =$data['battery'];
        $touch_or_non_touch =$data['touch_or_non_touch'];
        $dvd =$data['dvd'];
    }
    if($screen_resolution == '1280x1024'){
         $screen_resolution_type="SXGA";
    }elseif($screen_resolution == '1366x768'){
        $screen_resolution_type="HD";
    }elseif($screen_resolution == '1600x900'){
        $screen_resolution_type="HD+";
    }elseif($screen_resolution == '1920x1080'){
        $screen_resolution_type="FHD";
    }elseif($screen_resolution == '1920x1200'){
        $screen_resolution_type="WUXGA";
    }elseif($screen_resolution == '2560x1440'){
        $screen_resolution_type="QHD";
    }elseif($screen_resolution == '3440x1440'){
        $screen_resolution_type="WQHD";
    }elseif($screen_resolution == '3840x2160'){
        $screen_resolution_type="UHD";
    }elseif($screen_resolution == '1280 x 1024'){
         $screen_resolution_type="SXGA";
    }elseif($screen_resolution == '1366 x 768'){
        $screen_resolution_type="HD";
    }elseif($screen_resolution == '1600 x 900'){
        $screen_resolution_type="HD+";
    }elseif($screen_resolution == '1920 x 1080'){
        $screen_resolution_type="FHD";
    }elseif($screen_resolution == '1920 x 1200'){
        $screen_resolution_type="WUXGA";
    }elseif($screen_resolution == '2560 x 1440'){
        $screen_resolution_type="QHD";
    }elseif($screen_resolution == '3440 x 1440'){
        $screen_resolution_type="WQHD";
    }elseif($screen_resolution == '3840 x 2160'){
        $screen_resolution_type="UHD";
    }

}
$start=0;
$asin=0;
if (isset($_POST['submit'])) {
    $start=1;
        $device = $_POST["device"];
        $brand = $_POST["brand"];
        $processor = $_POST["processor"];
        $core = $_POST["core"];
        $generation = $_POST["generation"];
        $model = $_POST["model"];
        $location = $_POST["location"];
        $inventory_id = $_POST["inventory_id"];
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
        $inventory_id =trim($inventory_id);
        $comment = $_POST["comment"];
         $string = explode("-", $asin);
        $or_asin='';
        $or_asin=$string[1];
        $sql = strtolower("UPDATE `warehouse_information_sheet` 
        SET
                brand ='$brand',
                processor ='$processor',
                core ='$core',
                generation ='$generation',
                model ='$model',
                location ='$location',
                inventory_id ='$inventory_id',
                speed ='$speed',
                lcd_size ='$lcd_size',
                screen_resolution ='$screen_resolution',
                screen_resolution_type='$screen_resolution_type',
                battery ='$battery',
                touch_or_non_touch ='$touch_or_non_touch',
                dvd ='$dvd',
                keyboard_backlight ='$kb',
                asin ='$or_asin',
                comment='$comment',
                create_by_inventory_id='$username',
                reprint='1'
         WHERE `inventory_id` = '{$_POST['inventory_id']}'");
                 
                    $query1 = mysqli_query($connection, $sql);
                //    header('Location: warehouse_qr_report.php');
                // echo '<script type="text/javascript">';
                // echo 'alert("Success");';
                // echo 'window.location.href = "warehouse_qr_report.php";';
                // echo '</script>';

                // (A) IMAGE OBJECT
                if($kb==1){
                    $kb='Backlit ';
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
                $query = "SELECT ram,hard_disk_capacity FROM `asin_details` WHERE `asin_no`='$or_asin';";
                $query1 = mysqli_query($connection, $query);
                echo $query;
                foreach($query1 as $abc){
                     echo $ram;
                echo $hdd;
             
                    $ram=strToUpper($abc['ram']);
                    $hdd=strToUpper($abc['hard_disk_capacity']);
                }
               
                ///////////////////////////////////////////////////////////////////////
                
                    $im = imagecreatetruecolor(450, 200);

                    // Create some colors
                   $white = imagecolorallocate($im, 255, 255, 255);
                    $black = imagecolorallocate($im, 0, 0, 0);
                    imagefilledrectangle($im, 0, 0, 450, 200, $white);
                    
                    // Replace path by your own font path
                     $font = '../../static/dist/fonts/Poppins-Bold.ttf';

                    // Add some shadow to the text
                    
                    
                /////////////////////////////////////////////////////////////////////////
                $brand=strToUpper($brand);
                $model=strToUpper($model);
                $asin=strToUpper($asin);
                
                ///////////////////////////////////////////

                    // Add the text
                   imagettftext($im, 15, 0, 10, 15, $black, $font, "$brand    $model" );
                    imagettftext($im, 15, 0, 10, 35, $black, $font, "$core $speed $screen_resolution_type $touch_or_non_touch $kb");
                    if($ram !=0 && $hdd !=0){
                    imagettftext($im, 15, 0, 150, 80, $black, $font, "$ram GB / $hdd GB");
                    }
                    imagettftext($im, 15, 0, 10, 180, $black, $font, "ALSAKB $last_inventory_id");
                    imagettftext($im, 15, 0, 10, 200, $black, $font, "WH2-$generation-$model");
                    
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
                     $font = '../../static/dist/fonts/Poppins-Bold.ttf';
                    // Add some shadow to the text

                    // Add the text
                    
                    imagettftext($img, 14, 90, 25, 200, $black, $font, "$asin" );
                    
                    // Output to browser
                    header('Content-Type: image/png');
                    

                    imagepng($img, "asin/$username asin.png");
                    imagedestroy($img);
                    //////////////////////////////////////////////////////////////////////////////////////////
                  $dest = imagecreatefrompng(
                "files/$username test.png");
                $src = imagecreatefrompng(
                "temp/$inventory_id.png");
                 $src2 = imagecreatefrompng(
                "asin/$username asin.png");
                 
                // Copy and merge
                  imagecopymerge($dest, $src, 15, 50, 0, 0, 110, 110, 75);
                imagecopymerge($dest, $src2, 385, 0, 0, 0, 30, 200, 75);
                
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
                    'PC Update',
                    '$start_date',
                    '$start_date',
                    '1'
                    ) ";
                    $query_run = mysqli_query($connection, $query);
                //////////////////////////////////////////////////////////////////////////////////////////
                 header("Location: testimg.php");
}

?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>
    window.onload = function() {
        console.log("im here");
        brand = $("#brand").val();
        model = $("#model").val();
        core = $("#core").val();
        speed = $("#speed").val();
        screen_type = $("#touch_or_non_touch").val();
        console.log(brand);
        var getURL = "get_asin.php?brand=" + brand + "&model=" + model + "&core=" + core;
        console.log(getURL);
        $.get(getURL, function(data, status) {
            $("#asin").html(data);
        });

        asin.onchange = function() {
            asin = $("#asin").val();
            // var getURL = "get_asin.php?brand=" + brand + "&model=" + model + "&core=" + core;
            var getURL = "get_asin.php?asin=" + asin;
            console.log(getURL);
            $.get(getURL, function(data, status) {
                $("#note").html(data);
            });
        }
    }
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
                                            <option selected value="<?php echo $device; ?>"><?php echo $device; ?>
                                            </option>

                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Brand</label>
                                    <div class="col-sm-8">
                                        <select class="w-100" name="brand" id="brand" style="border-radius: 5px;"
                                            required>
                                            <option selected><?php echo $brand; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Model</label>
                                    <div class="col-sm-8 w-100">
                                        <select class="w-100" name="model" id="model" style="border-radius: 5px;"
                                            required>
                                            <option selected><?php echo $model; ?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Processor</label>
                                    <div class="col-sm-8">
                                        <select class="w-100" name="processor" id="processor"
                                            style="border-radius: 5px;" required>
                                            <option selected><?php echo $processor; ?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Core</label>
                                    <div class="col-sm-8">
                                        <select class="w-100" name="core" id="core" style="border-radius: 5px;"
                                            required>
                                            <option selected value="<?php echo $core; ?>"><?php echo $core; ?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Generation</label>
                                    <div class="col-sm-8">
                                        <select class="w-100" name="generation" id="generation"
                                            style="border-radius: 5px;" required>
                                            <option selected><?php echo $generation; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Speed</label>
                                    <div class="col-sm-8 w-100">
                                        <select class="w-100" name="speed" id="speed" style="border-radius: 5px;"
                                            required>
                                            <option selected><?php echo $speed; ?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label">LCD Size</label>
                                    <div class="col-sm-8 w-100">
                                        <select class="w-100" name="lcd_size" id="lcd_size" style="border-radius: 5px;"
                                            required>
                                            <option selected><?php echo $lcd_size; ?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Screen Resolution</label>
                                    <div class="col-sm-8 w-100">
                                        <select class="w-100" name="screen_resolution" id="screen_resolution"
                                            style="border-radius: 5px;" required>
                                            <option selected><?php echo $screen_resolution; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Screen Resolution Type</label>
                                    <div class="col-sm-8 w-100">
                                        <select class="w-100" name="screen_resolution_type" id="screen_resolution_type"
                                            style="border-radius: 5px;" required>
                                            <option selected><?php echo $screen_resolution_type; ?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Screen Type (TOUCH / NONE TOUCH)</label>
                                    <div class="col-sm-8 w-100">
                                        <select class="w-100" name="touch_or_non_touch" id="touch_or_non_touch"
                                            style="border-radius: 5px;" required>
                                            <option selected><?php echo $touch_or_non_touch; ?></option>
                                        </select>

                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Battery</label>
                                    <div class="col-sm-8 w-100">
                                        <select class="w-100" name="battery" style="border-radius: 5px;" required>
                                            <option selected><?php echo $battery; ?></option>
                                        </select>

                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Optical</label>
                                    <div class="col-sm-8 w-100">
                                        <select class="w-100" name="dvd" style="border-radius: 5px;" required>
                                            <option selected><?php echo $dvd; ?></option>
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
                                            <!-- <option selected><?php echo $location; ?></option> -->
                                            <option selected value="WH2">WH2</option>

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