 <?php
session_start();
include_once '../../dataAccess/connection.php';
include_once '../../dataAccess/functions.php';
include_once '../../dataAccess/403.php';
include_once '../includes/header.php';
?>
 <link rel="stylesheet" href="../../static/plugins/bootstrap-3.3.5-dist/css/bootstrap.min.css">
 <script src="../../static/plugins/jquery/1.11.3/jquery.min.js"></script>
 <script src="../../static/plugins/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
 <?php
// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
}
$test_id = 0;
$test_name = 0;
if (empty($_GET['user_id'])) {
} else {
    $test_id = $_GET['user_id'];
    $test_name = $_GET['username'];
    if ($test_id != 0) {
        echo "<script>
    $(window).load(function() {
        $('#myModal69').modal('show');
    });
    </script>";
    }
}
if (empty($_GET['technician_id'])) {
} else {
    $technician_id = $_GET['technician_id'];
    $start_time = $_GET['start_time'];
    $qr_number = $_GET['qr_number'];

    echo "<script>
    $(window).load(function() {
        $('#myModal67').modal('show');
    });
    </script>";
}
?>
 <div class="row page-titles">
     <div class="col-md-5 align-self-center mt-2"><a href="./bod_lead.php">
             <i class="fa-solid fa-left fa-4x " style="color: #ced4da;"></i>
         </a>
     </div>
 </div>
 <div class='row pt-5'>
     <div class="col col-lg-6 justify-content-center  text-uppercase">
         <table id="tblexportData" class="table table-striped">
             <thead>
                 <th>Employee Name</th>
                 <th>Assigned QTY</th>
                 <th>Completed QTY</th>
                 <th>Not Completed QTY</th>
             </thead>
             <tbody>
                 <?php
                    $query = "SELECT username,user_id FROM users WHERE department='7' AND role='4' ";
                    $query_run = mysqli_query($connection, $query);

                    foreach ($query_run as $data) {
                        $username = $data['username'];
                        $user_id = $data['user_id'];
                    ?>
                 <tr>
                     <td><a
                             href="bodywork_team_performance.php?user_id=<?php echo $user_id ?>&username=<?php echo $username ?>"><?php echo $username; ?></a>
                     </td>
                     <td><?php
                                $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                $date = $date1->format('Y-m-d 00:00:00');
                                $date2 = $date1->format('Y-m-d 23:59:59');
                                $okkoma = 0;
                                $iwara = 0;
                                $query = "SELECT COUNT(technician_id) AS technician_id FROM performance_record_table WHERE technician_id='$username' AND  (job_description='send to Bodywork' OR job_description='send to Sanding' OR job_description='send to Taping' ) AND start_time between '$date'AND '$date2'";
                                $query_run = mysqli_query($connection, $query);
                                foreach ($query_run as $a) {
                                    echo $a['technician_id'];
                                    $okkoma = $a['technician_id'];
                                } ?></td>
                     <td><?php
                                $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
                                $date = $date1->format('Y-m-d 00:00:00');
                                $date2 = $date1->format('Y-m-d 23:59:59');
                                $query = "SELECT COUNT(status) AS status1 FROM performance_record_table WHERE user_id='$user_id' AND  status='1' AND start_time between '$date'AND '$date2'";
                                $query_run = mysqli_query($connection, $query);

                                foreach ($query_run as $b) {
                                    echo $b['status1'];
                                    $iwara = $b['status1'];
                                } ?></td>
                     <td><?php $ithuru = $okkoma - $iwara;
                                echo $ithuru; ?></td>
                 </tr>
                 <?php }
                    ?>

             </tbody>
         </table>
     </div>
 </div>
 <div class="modal fade " id="myModal69" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     data-backdrop="static" data-keyboard="false" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content ">
             <div class="modal-header col-lg-12" style=" font-size: 30px;">
                 <?php $query = "SELECT COUNT(qr_number) as test, qr_number FROM performance_record_table WHERE technician_id='$test_name' AND start_time between '$date'AND '$date2'";
                $query_run = mysqli_query($connection, $query);
                $test = 0;
                foreach ($query_run as $data) {
                    $test = $data['test'];
                } ?>
                 <?php echo $test_name; ?>Technician All Details
             </div>
             <div>Assigned Count : <?php echo $test; ?></div>
             <div>
                 <div class='row'>
                     <div class="col col-lg-12 justify-content-center m-auto text-uppercase">
                         <table id="tblexportData" class="table table-striped">
                             <thead>
                                 <th>Assigned QR Code</th>
                                 <th>status</th>
                                 <th>Job Description</th>
                             </thead>
                             <tbody>
                                 <?php
                                $query = "SELECT qr_number FROM performance_record_table WHERE technician_id='$test_name' AND start_time between '$date'AND '$date2'";
                                $query_run = mysqli_query($connection, $query);
                                foreach ($query_run as $data) {
                                    $qr_number = $data['qr_number'];
                                ?><tr>
                                     <td><?php echo $qr_number; ?></td>
                                     <?php
                                        $query = "SELECT status,job_description FROM performance_record_table WHERE user_id='$test_id' AND qr_number='$qr_number' AND start_time between '$date'AND '$date2'";
                                        $query_run = mysqli_query($connection, $query);
                                        $status1 = 300;
                                        $jd = 'Not Start Yet';
                                        foreach ($query_run as $data) {
                                            $status1 = $data['status'];
                                            $jd = $data['job_description'];
                                        }
                                        ?>
                                     <td><?php if ($status1 == 1) {
                                                echo "Completed";
                                            } elseif ($status1 == 0) {
                                                echo "On Going";
                                            } else {
                                                echo "Not Start";
                                            } ?>
                                     </td>
                                     <td><?php echo $jd ?></td>
                                 </tr>
                                 <?php
                                }
                                ?>
                             </tbody>
                         </table>
                     </div>
                 </div>

             </div>
             <button data-dismiss="modal" class="close " type="button" area-label="close">
                 <div class="w-10">close</div>
             </button>
         </div>

     </div>
 </div>