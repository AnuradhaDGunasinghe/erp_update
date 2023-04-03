<style>
.circle1,
.circle2 {
    width: 100px;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 10px;
    border: 0px;
}

.boxx {
    display: flex;
}
</style>
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
$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['role_id'];
$department_id = $_SESSION['department'];

$date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
date_default_timezone_set('Asia/Dubai');
$timestamp1 = strtotime(date('Y-m-d 8:59:55'));
$timestamp2 = strtotime(date('Y-m-d 13:56:50'));
$timestamp3 = strtotime(date('Y-m-d 18:47:00'));
$timestamp4 = strtotime(date('Y-m-d 20:57:00'));
$_SESSION['expire0'] = $timestamp1;
$_SESSION['expire1'] = $timestamp2;
$_SESSION['expire2'] = $timestamp3;
$_SESSION['expire3'] = $timestamp4;
$now = time();
// later
//   $after_tea_timestart =strtotime(date('Y-m-d 18:44:00'));
//   $after_tea_timeend=strtotime(date('Y-m-d 20:57:00'));
//   $after_lunch_timestart =strtotime(date('Y-m-d 14:59:00'));
//   $after_lunch_timeend=strtotime(date('Y-m-d 18:17:00'));
//   $morning_session_timestart =strtotime(date('Y-m-d 18:59:00'));
//   $morning_session_timeend=strtotime(date('Y-m-d 19:37:00'));
if (strtotime(date('Y-m-d 08:00:00')) < $now && $now > $_SESSION['expire0'] && $now < strtotime(date('Y-m-d 9:00:00'))) {
    // header("Location: ../../index.php");
    session_destroy();
    echo "<p align='center'>Session has been destroyed!!";
    // session_start();
    header("Location: ../../index.php");
} elseif (strtotime(date('Y-m-d 09:00:00')) < $now && $now > $_SESSION['expire1'] && $now < strtotime(date('Y-m-d 15:00:00'))) {
    // header("Location: ../../index.php");
    session_destroy();
    echo "<p align='center'>Session has been destroyed!!";
    // session_start();
    header("Location: ../../index.php");
} elseif (strtotime(date('Y-m-d 15:00:00')) < $now && $now > $_SESSION['expire2'] && $now < strtotime(date('Y-m-d 18:47:50'))) {
    session_destroy();
    echo "<p align='center'>Session has been destroyed!!";
    header("Location: ../../index.php");
} elseif (strtotime(date('Y-m-d 19:14:00')) < $now && $now > $_SESSION['expire3'] && $now < strtotime(date('Y-m-d 20:55:50'))) {
    session_destroy();
    echo "<p align='center'>Session has been destroyed!!";
    header("Location: ../../index.php");
}
// if (1682048622 < $now) {
//     session_destroy();
//     echo "<p align='center'>Session has been destroyed!!";
//     header("Location: ../../index.php");
// }

if(isset($_POST['on'])){
 $user=$_POST['user'];
 $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
    $start_date = $date1->format('Y-m-d H:i:s');
  $query = "INSERT INTO `performance_record_table`(
                `user_id`,
                `department_id`,
                `qr_number`,
                `job_description`,
                `start_time`,
                status
                )
                VALUES(
                '$user_id',
                '$department_id',
                'sorting no qr code',
                'sorting',
                '$start_date',
                '0'
                ) ";
    $query_run = mysqli_query($connection, $query);
    header('Location: sorting_temp.php');
}
if(isset($_POST['end'])){
    $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
    $end_date = $date1->format('Y-m-d H:i:s');
    $performance_id=$_POST['performance_id'];
    $start_time=$_POST['start_time'];
    $query = "UPDATE `performance_record_table` SET end_time='$end_date',start_time='$start_time' WHERE performance_id='$performance_id' ";
    $query_run = mysqli_query($connection, $query);
    header('Location: sorting_temp.php');
}
?>

<div class="row ">
    <div class="col col-lg-12 justify-content-center m-auto text-uppercase">
        <div class="row ">
            <div class="col-lg-11 grid-margin stretch-card justify-content-center mx-auto ">
                <div class="card mt-3">
                    <div class="card-body">
                        <?php $query = "SELECT job_description FROM performance_record_table WHERE user_id ='$user_id' ORDER BY performance_id DESC LIMIT 1";
                        $query_run = mysqli_query($connection, $query);
                        $last_job = '';
                        foreach ($query_run as $data) {
                            $last_job = $data['job_description'];
                        }
                        ?>
                        <h1> Name :
                            <?php
                            $emp_id = $_SESSION['epf'];
                            $query = "SELECT full_name FROM employees WHERE emp_id ='$emp_id'";
                            $query_run = mysqli_query($connection, $query);
                            foreach ($query_run as $data) {
                                echo $data['full_name'];
                            } ?><br>
                            EmpID :<?php echo $_SESSION['epf'] ?><br>
                            Department :
                            <?php
                            $query = "SELECT department FROM departments WHERE department_id='$department_id'";
                            $query_run = mysqli_query($connection, $query);
                            foreach ($query_run as $data) {
                                echo $data['department'];
                            }
                            ?>
                        </h1>
                        <div class="d-flex">
                            <div class="col-lg-6 grid-margin stretch-card justify-content-center mx-auto mt-2">
                                <div class="boxx w-100">
                                    <?php 
                                    $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                        $date = $date1->format('Y-m-d 09:00:00');
                                        $date2 = $date1->format('Y-m-d 21:55:50');
                                    $sql="SELECT performance_id,start_time,end_time FROM performance_record_table WHERE job_description='sorting' AND user_id='$user_id' ORDER BY performance_id DESC LIMIT 1";
                                    $sql_run = mysqli_query($connection,$sql);
                                    $rows=mysqli_num_rows($sql_run);
                                    if($rows ==0 ){
                                        echo "
                                        <form method='POST'>
                                        <input type='hidden' name='user' value='1'>
                                        <button type='submit' name='on' class='circle1 bg-success rounded-circle'>Start</button>
                                        </form>";
                                    }else{
                                        $start_time=0;
                                        $end_time=0;
                                        $performance_id=0;
                                        foreach($sql_run as $data){
                                            $start_time=$data['start_time'];
                                            $end_time=$data['end_time'];
                                            $performance_id=$data['performance_id'];
                                        }
                                        if($end_time !="0000-00-00 00:00:00"){
                                           echo "
                                         <form method='POST'>
                                        <input type='hidden' name='user' value='1'>
                                        <button type='submit' name='on' class='circle1 bg-success rounded-circle'>Start</button>
                                        </form>";
                                        }else{
                                          echo "
                                         <form method='POST'>
                                          <input type='hidden' name='performance_id' value='$performance_id'>
                                         <input type='hidden' name='start_time' value='$start_time'>
                                        <button type='submit' name='end' class='circle1 bg-info rounded-circle'>End</button>
                                        </form>";
                                        }
                                    }
                                    ?>


                                </div>

                            </div>
                            <div class="col-lg-6 grid-margin stretch-card justify-content-center mx-auto mt-2">
                                <div class="text-danger">

                                    <div class="row">
                                        <label class="col-sm-12 col-form-label">Morning Session Start Time :
                                            09.05AM</label>
                                        <?php
                                        $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                        $date = $date1->format('Y-m-d 09:00:00');
                                        $date2 = $date1->format('Y-m-d 13:55:50');
                                        $duration = 0;
                                        $spend_time = 0;
                                        $query = "SELECT start_time  FROM performance_record_table WHERE user_id=$user_id AND start_time between '$date'AND '$date2' ORDER BY performance_id ASC LIMIT 1";
                                        $query_run = mysqli_query($connection, $query);
                                        $datetime_1 = '';
                                        $datetime_2 = '';
                                        foreach ($query_run as $data) {
                                            $datetime_1 = date('Y-m-d 09:05:00');
                                            $datetime_2 = $data['start_time'];
                                        }

                                        $start_datetime = new DateTime($datetime_1);
                                        $diff = $start_datetime->diff(new DateTime($datetime_2));
                                        if ($datetime_2 != '') {
                                            $description = "morning session start";
                                            $query = "SELECT track_id FROM time_track WHERE user_id='$user_id' AND description='$description' AND date between '$date'AND '$date2'";
                                            $query_run_for_time = mysqli_query($connection, $query);
                                            $exist_record = 0;
                                            foreach ($query_run_for_time as $time) {
                                                $exist_record = $time['track_id'];
                                            }
                                            if ($datetime_2 < $datetime_1) {

                                        ?>
                                        <label class="col-sm-12 col-form-label text-success">You are Earlier :
                                            <?php echo $diff->format('%H:%i:%s');
                                                        echo " HH:MM:ss"; ?>
                                            &#128525;</label>
                                        <?php
                                                if ($exist_record == 0) {
                                                    $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','1')";
                                                    $query_run = mysqli_query($connection, $query);
                                                }
                                            } else {
                                                ?>
                                        <label class="col-sm-12 col-form-label text-danger">You are Late :
                                            <?php echo $diff->format('%H:%i:%s');
                                                        echo " HH:MM:ss"; ?>
                                        </label>
                                        <?php
                                                if ($exist_record == 0) {
                                                    $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','0')";
                                                    $query_run = mysqli_query($connection, $query);
                                                }
                                            }
                                        }
                                        ?>
                                        <label class="col-sm-12 col-form-label">Lunch Break Start Time : 01.55PM
                                            <?php
                                            $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                            $current_time = $date1->format('Y-m-d H:i:s');
                                            $date = $date1->format('Y-m-d 13:55:50');
                                            $remaining_time = (strtotime($date) - strtotime($current_time)) / 60;
                                            if ($remaining_time > 0) {
                                                // echo " Remaining Time " . round($remaining_time) . " minute";
                                            }
                                            ?>
                                        </label>
                                        <?php
                                        $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                        $date = $date1->format('Y-m-d 13:30:00');
                                        $date2 = $date1->format('Y-m-d 13:57:00');
                                        $duration = 0;
                                        $spend_time = 0;
                                        $query = "SELECT end_time  FROM performance_record_table WHERE user_id=$user_id AND end_time between '$date'AND '$date2' ORDER BY end_time DESC LIMIT 1";
                                        $query_run = mysqli_query($connection, $query);
                                        $datetime_1 = '';
                                        $datetime_2 = '';
                                        foreach ($query_run as $data) {
                                            $datetime_1 = date('Y-m-d 13:55:00');
                                            $datetime_2 = $data['end_time'];
                                        }

                                        $start_datetime = new DateTime($datetime_1);
                                        $diff = $start_datetime->diff(new DateTime($datetime_2));
                                        if ($datetime_2 != '') {
                                            $description = "Lunch Break start";
                                            $query = "SELECT track_id FROM time_track WHERE user_id='$user_id' AND description='$description' AND date between '$date'AND '$date2'";
                                            $query_run_for_time = mysqli_query($connection, $query);
                                            $exist_record = 0;
                                            foreach ($query_run_for_time as $time) {
                                                $exist_record = $time['track_id'];
                                            }
                                            if ($datetime_2 < $datetime_1) {

                                        ?>
                                        <label class="col-sm-12 col-form-label text-danger">You are Earlier :
                                            <?php 
                                            // echo $diff->i . ' Minutes';
                                            echo $diff->format('%H:%i:%s');
                                                        echo " HH:MM:ss";
                                            ?></label>
                                        <?php
                                                if ($exist_record == 0) {
                                                    $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','1')";
                                                    $query_run = mysqli_query($connection, $query);
                                                }
                                            } elseif($datetime_2 > $datetime_1) {
                                                ?>
                                        <label class="col-sm-12 col-form-label text-success">You are Late :
                                            <?php  echo $diff->format('%H:%i:%s');
                                                        echo " HH:MM:ss"; ?>
                                            &#128525;
                                        </label>
                                        <?php
                                                if ($exist_record == 0) {
                                                    $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','0')";
                                                    $query_run = mysqli_query($connection, $query);
                                                }
                                            }
                                        }
                                        ?>

                                        <label class="col-sm-12 col-form-label">Afternoon Session Start Time :
                                            03.05PM</label>
                                        <?php
                                        $date = date('Y-m-d 15:00:00');
                                        $date2 = date('Y-m-d 18:15:00');
                                        $query = "SELECT start_time  FROM performance_record_table WHERE user_id=$user_id AND start_time between '$date'AND '$date2' ORDER BY performance_id ASC LIMIT 1";
                                        $query_run = mysqli_query($connection, $query);
                                        $datetime_1 = '';
                                        $datetime_2 = '';
                                        foreach ($query_run as $data) {
                                            $datetime_1 = date('Y-m-d 15:05:00');
                                            $datetime_2 = $data['start_time'];
                                        }

                                        $start_datetime = new DateTime($datetime_1);
                                        $diff = $start_datetime->diff(new DateTime($datetime_2));

                                        if ($datetime_2 != '') {
                                            $description = "afternoon session start";
                                            $query = "SELECT track_id FROM time_track WHERE user_id='$user_id' AND description='$description' AND date between '$date'AND '$date2'";
                                            $query_run_for_time = mysqli_query($connection, $query);
                                            $exist_record = 0;
                                            foreach ($query_run_for_time as $time) {
                                                $exist_record = $time['track_id'];
                                            }
                                            if ($datetime_2 < $datetime_1) {

                                        ?>
                                        <label class="col-sm-12 col-form-label text-success">You are Earlier :
                                            <?php  echo $diff->format('%H:%i:%s');
                                                        echo " HH:MM:ss"; ?>
                                            &#128525;</label>
                                        <?php
                                                if ($exist_record == 0) {
                                                    $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','1')";
                                                    $query_run = mysqli_query($connection, $query);
                                                }
                                            } else {
                                                ?>
                                        <label class="col-sm-12 col-form-label text-danger">You are Late :
                                            <?php  echo $diff->format('%H:%i:%s');
                                                        echo " HH:MM:ss"; ?>
                                        </label>
                                        <?php
                                                if ($exist_record == 0) {
                                                    $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','0')";
                                                    $query_run = mysqli_query($connection, $query);
                                                }
                                            }
                                        } ?>
                                        <label class="col-sm-12 col-form-label">Tea Break Start Time : 06.45PM
                                            <?php
                                            $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                            $current_time = $date1->format('Y-m-d H:i:s');
                                            $date = $date1->format('Y-m-d 18:45:20');
                                            $date_old = $date1->format('Y-m-d 15:05:00');
                                            $remaining_time = (strtotime($date) - strtotime($current_time)) / 60;
                                            // if ($remaining_time > 0 && $date_old < $current_time) {
                                            //     echo " Remaining Time " . round($remaining_time) . " minute";
                                            // }
                                            ?>
                                        </label>
                                        <label>
                                            <?php
                                            $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                            $date = $date1->format('Y-m-d 18:25:00');
                                            $date2 = $date1->format('Y-m-d 19:10:50');
                                            $duration = 0;
                                            $spend_time = 0;
                                            $query = "SELECT end_time  FROM performance_record_table WHERE user_id=$user_id AND end_time between '$date'AND '$date2' ORDER BY end_time DESC LIMIT 1";
                                            $query_run = mysqli_query($connection, $query);
                                            $datetime_1 = '';
                                            $datetime_2 = '';
                                            foreach ($query_run as $data) {
                                                $datetime_1 = date('Y-m-d 18:45:00');
                                                $datetime_2 = $data['end_time'];
                                            }

                                            $start_datetime = new DateTime($datetime_1);
                                            $diff = $start_datetime->diff(new DateTime($datetime_2));
                                            if ($datetime_2 != '') {
                                                $description = "tea session start";
                                                $query = "SELECT track_id FROM time_track WHERE user_id='$user_id' AND description='$description' AND date between '$date'AND '$date2'";
                                                $query_run_for_time = mysqli_query($connection, $query);
                                                $exist_record = 0;
                                                foreach ($query_run_for_time as $time) {
                                                    $exist_record = $time['track_id'];
                                                }
                                                if ($datetime_2 < $datetime_1) {

                                            ?>
                                            <label class="col-sm-12 col-form-label text-danger">You are Earlier :
                                                <?php  echo $diff->format('%H:%i:%s');
                                                        echo " HH:MM:ss"; ?></label>
                                            <?php
                                                    if ($exist_record == 0) {
                                                        $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','1')";
                                                        $query_run = mysqli_query($connection, $query);
                                                    }
                                                } elseif($datetime_2 > $datetime_1) {
                                                    ?>
                                            <label class="col-sm-12 col-form-label text-success">You are Late :
                                                <?php  echo $diff->format('%H:%i:%s');
                                                        echo " HH:MM:ss";?>
                                                &#128525;
                                            </label>
                                            <?php
                                                    if ($exist_record == 0) {
                                                        $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','0')";
                                                        $query_run = mysqli_query($connection, $query);
                                                    }
                                                }
                                            }
                                            ?>
                                            </lable>
                                            <label class="col-sm-12 col-form-label">Evening Session Start Time :
                                                07.15PM</label>
                                            <?php
                                            $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                            $date = $date1->format('Y-m-d 19:12:00');
                                            $date2 = $date1->format('Y-m-d 20:55:00');
                                            $duration = 0;
                                            $spend_time = 0;
                                            $query = "SELECT start_time  FROM performance_record_table WHERE user_id=$user_id AND start_time between '$date'AND '$date2' ORDER BY performance_id ASC LIMIT 1";
                                            $query_run = mysqli_query($connection, $query);
                                            $datetime_1 = '';
                                            $datetime_2 = '';
                                            foreach ($query_run as $data) {
                                                $datetime_1 = date('Y-m-d 19:15:00');
                                                $datetime_2 = $data['start_time'];
                                            }

                                            $start_datetime = new DateTime($datetime_1);
                                            $diff = $start_datetime->diff(new DateTime($datetime_2));
                                            if ($datetime_2 != '') {
                                                $description = "evening session start";
                                                $query = "SELECT track_id FROM time_track WHERE user_id='$user_id' AND description='$description' AND date between '$date'AND '$date2'";
                                                $query_run_for_time = mysqli_query($connection, $query);
                                                $exist_record = 0;
                                                foreach ($query_run_for_time as $time) {
                                                    $exist_record = $time['track_id'];
                                                }
                                                if ($datetime_2 < $datetime_1) {

                                            ?>
                                            <label class="col-sm-12 col-form-label text-success">You are Earlier :
                                                <?php echo $diff->format('%H:%i:%s');
                                                        echo " HH:MM:ss"; ?>
                                                &#128525;</label>
                                            <?php
                                                    if ($exist_record == 0) {
                                                        $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','1')";
                                                        $query_run = mysqli_query($connection, $query);
                                                    }
                                                } else {
                                                    ?>
                                            <label class="col-sm-12 col-form-label text-danger">You are Late :
                                                <?php echo $diff->format('%H:%i:%s');
                                                        echo " HH:MM:ss"; ?>
                                            </label>
                                            <?php
                                                    if ($exist_record == 0) {
                                                        $query = "INSERT INTO `time_track`( `user_id`, `description`, `time`, `status`) VALUES ('$user_id','$description','$diff->h:$diff->i','0')";
                                                        $query_run = mysqli_query($connection, $query);
                                                    }
                                                }
                                            }
                                            ?>
                                            <label class="col-sm-12 col-form-label">Evening Session End Time : 08.55PM
                                                <?php
                                                $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                                $current_time = $date1->format('Y-m-d H:i:s');
                                                $date = $date1->format('Y-m-d 20:55:50');
                                                $remaining_time = (strtotime($date) - strtotime($current_time)) / 60;
                                                $date_old = $date1->format('Y-m-d 19:15:00');
                                                if ($remaining_time > 0 && $date_old < $current_time) {
                                                    // echo " Remaining Time " . round($remaining_time) . " minute";
                                                }
                                                ?>
                                            </label>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php if (($department_id != 1) || ($department_id == 1 && $user_role != 9)) { ?>
                        <table id="tblexportData" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Job Description</th>

                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Time Duration</th>

                                </tr>
                            </thead>
                            <tbody>


                                <?php
                                    $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                    $date = $date1->format('Y-m-d 00:00:00');
                                    $date2 = $date1->format('Y-m-d 23:59:59');
                                    $spend_time = 0;
                                    $query = "SELECT * FROM performance_record_table WHERE user_id=$user_id AND start_time between '$date'AND '$date2' ORDER BY performance_id DESC";

                                    $query_run = mysqli_query($connection, $query);
                                    $row = mysqli_num_rows($query_run);
                                    foreach ($query_run as $data) {
                                    ?>
                                <tr>
                                    <td><?php echo $data['job_description'] ?></td>
                                    <td><?php echo $data['start_time'] ?></td>
                                    <td><?php echo $data['end_time'] ?></td>
                                    <td><?php 
                                    $start_time=$data['start_time'];
                                    $end_date1=$data['end_time'];
                                    $session1_start = $date1->format('Y-m-d H:i:s');
                                    $session1_start = new DateTime($start_time);
                                    $end_date = new DateTime($end_date1);
                                    $diff = $session1_start->diff($end_date);
                                    $hours   = $diff->format('%h'); 
                                    $minutes = $diff->format('%i');
                                    $sec = $diff->format('%s');
                                    $spend_time= "$hours:$minutes:$sec";
                                    if( $end_date1 != '0000-00-00 00:00:00' ){
                                        echo $spend_time;
                                    }else{
                                        echo "00:00:00";
                                    }
                                    
                                    
                                    ?></td>
                                </tr>
                                <?php }
                                    } ?>

                            </tbody>
                        </table>