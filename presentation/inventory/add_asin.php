<?php
ob_start();
session_start();
include_once '../../dataAccess/connection.php';
include_once '../../dataAccess/functions.php';
include_once '../../dataAccess/403.php';
include_once '../includes/header.php';
?>

<style>
/* Scroll Bar Styles */
/* width */
::-webkit-scrollbar {
    height: 5px;
}

/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* ///////////// */

.excelUplorder {
    /* margin-top: 10px; */
    /* margin-left: 10px; */
}

.tableSec {
    overflow-x: auto;
    height: 50vh;
    overflow-y: auto;
    background-color: #6c757d;
}

.detailTable table th {
    text-align: center;
}
</style>


<?php 
 $i=0;
if (isset($_POST['submit'])) {
    echo "inside submit";
    if ($_FILES['file']['name']) {
        $filename = explode('.', $_FILES['file']['name']);
        if ($filename[1] == 'csv') {
            $handle = fopen($_FILES['file']['tmp_name'], 'r');
           echo "file";
            while ($data = fgetcsv($handle)) {
                //handling csv file
                $i++;
               $serial_no=rtrim($data[0]);
               $asin_no=rtrim($data[1]);
               $brand=rtrim($data[2]);
               $model=rtrim($data[3]);
               $lcd_size=rtrim($data[4]);
               $resolution=rtrim($data[5]);
               $resolution_type=rtrim($data[6]);
               $touch_or_none_touch=rtrim($data[7]);
               $processor=rtrim($data[8]);
               $core=rtrim($data[9]);
               $speed=rtrim($data[10]);
               $generation=rtrim($data[11]);
               $ram=rtrim($data[12]);
               $hard_disk_capacity=rtrim($data[13]);
               $keyboard_backlight=rtrim($data[14]);
               $camera=rtrim($data[15]);
               $wifi=rtrim($data[16]);
               $bluetooth=rtrim($data[17]);
               $hdmi=rtrim($data[18]);
               $optical=rtrim($data[19]);
               $fingerprint=rtrim($data[20]);
               $os=rtrim($data[21]);


                strtolower($serial_no) ;
                strtolower($asin_no) ;
                strtolower($brand) ;
                strtolower($model) ;
                strtolower($lcd_size) ;
                strtolower($resolution) ;
                strtolower($resolution_type) ;
                strtolower($touch_or_none_touch) ;
                strtolower($processor) ;
                strtolower($core) ;
                strtolower($speed) ;
                strtolower($generation) ;
                strtolower($ram) ;
                strtolower($hard_disk_capacity) ;
                strtolower($keyboard_backlight) ;
                strtolower($camera) ;
                strtolower($wifi) ;
                strtolower($bluetooth) ;
                strtolower($hdmi) ;
                strtolower($optical) ;
                strtolower($fingerprint) ;
                strtolower($os) ;
if($i > 2){
     $sql = strtolower("INSERT INTO asin_details(`serial_no`,
    `asin_no`,
    `brand`,
    `model`,
    `lcd_size`,
    `resolution`,
    `resolution_type`,
    `touch_or_none_touch`,
    `processor`,
    `core`,
    `speed`,
    `generation`,
    `ram`,
    `hard_disk_capacity`,
    `keyboard_backlight`,
    `camera`,
    `wifi`,
    `bluetooth`,
    `hdmi`,
    `optical`,
    `fingerprint`,
    `os`) 
     VALUES('$serial_no',
            '$asin_no',
            '$brand',
            '$model',
            '$lcd_size',
            '$resolution',
            '$resolution_type',
            '$touch_or_none_touch',
            '$processor',
            '$core',
            '$speed',
            '$generation',
            '$ram',
            '$hard_disk_capacity',
            '$keyboard_backlight',
            '$camera',
            '$wifi',
            '$bluetooth',
            '$hdmi',
            '$optical',
            '$fingerprint',
            '$os')");
     
                mysqli_query($connection, $sql);
}
            }
            fclose($handle);
            // echo '<script>alert("File Sucessfully imported")</script>';
            
        }
    }
} ?>


<div class="pageContainer">
    <div class="pageHeader text-center py-2 bg-secondary">
        <h2><i class="fa-solid fa-layer-plus pr-2 pl-2 " style="font-size: 25px;"></i>Add Pending Machine Details</h2>
    </div>
    <div class="pageBody">
        <div class="row col-md-12">
            <!-- uploder Section -->
            <div class="excelUplorder col-md-7">
                <br>
                <div class="row col-md-12">
                    <h5>Upload Detail Sheet Here ..</h5>
                </div>
                <div class="row col-md-12">
                    <div class="uplordBtnSec col-md-12">
                        <!-- <form method="post" enctype="multipart/form-data">
                        <input type="file" name="file">                    
                    </form> -->
                        <form method="post" enctype="multipart/form-data">
                            <label>Select CSV File:</label><br>
                            <input class="btn btn-success mt-2" type="file" name="file">
                            <input class="btn btn-success col-md-3 mt-2" type="submit" name="submit" value="Submit"
                                style="height: 40px;">
                        </form>

                    </div>
                </div>
            </div>
        </div>



        <br>



    </div>
</div>

<?php include_once '../includes/footer.php'; ?>