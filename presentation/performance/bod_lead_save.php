<?php
session_start();
include_once '../../dataAccess/connection.php';
include_once '../../dataAccess/functions.php';

$scanned_qr = '0';
$scanned_mfg = '0';
$search_value;
$scanned_qr = trim($_POST['qr']);
$job_description = $_POST['job_description'];
$user_id = trim($_POST['user_id']);
$technician_id = trim($_POST['technician_id']);
$user_role = $_POST['user_role'];
$department_id = $_POST['department_id'];
$date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
$start_date = $date1->format('Y-m-d H:i:s');
$sql="SELECT technician_id,start_time,qr_number FROM performance_record_table WHERE user_id='$user_id' AND job_description='$job_description' AND qr_number='$scanned_qr'";
$query_run = mysqli_query($connection, $sql);
$row=mysqli_num_rows($query_run);

if($row==0){
$query = "INSERT INTO `performance_record_table`(
    `user_id`,
    `department_id`,
    `qr_number`,
    `job_description`,
    `start_time`,
    `end_time`,
    status,
    `target`,
    technician_id
    )
    VALUES(
    '$user_id',
    '$department_id', 
    '$scanned_qr',
    '$job_description',
    '$start_date',
    '$start_date',
    '1',
    '1',
    '$technician_id'
    )";
$query_run = mysqli_query($connection, $query);
header('Location: bod_lead.php');
    }else{
        $technician_id=0;
        $start_time=0;
        $qr_number=0;
        foreach($query_run as $data){
            $technician_id=$data['technician_id'];
            $start_time=$data['start_time'];
            $qr_number=$data['qr_number'];
        }
        header("Location: bod_lead.php?technician_id='$technician_id'&start_time='$start_time'&qr_number='$qr_number'");

    }