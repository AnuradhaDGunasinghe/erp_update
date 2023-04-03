<?php
include_once '../../dataAccess/connection.php';
include_once '../../dataAccess/functions.php';

$sql="SELECT * FROM qc_paper where status ='1' AND date_time between '2023-03-01 00:00:00' AND '2023-03-25 21:00:00'";
$sql_query=mysqli_query($connection,$sql);
 $i=0;
foreach($sql_query as $data){
    
                $bios_lock_hp = $data['bios_lock_hp'];
                $bios_lock_dell = $data['bios_lock_dell'];
                $bios_lock_lenovo = $data['bios_lock_lenovo'];
                $bios_lock_other = $data['bios_lock_other'];

                $computrace_hp = $data['computrace_hp'];
                $computrace_dell = $data['computrace_dell'];
                $computrace_lenovo = $data['computrace_lenovo'];
                $computrace_other = $data['computrace_other'];

                $me_region_lock_hp = $data['me_region_lock_hp'];
                $tpm_lock_dell = $data['tpm_lock_dell'];
                $other_error_lenovo = $data['other_error_lenovo'];
                $other_error_other_brand = $data['other_error_other_brand'];

                $no_power = $data['power'];
                $no_display = $data['mb_display'];
                $other_issue = $data['mb_other_issue'];
                $bodywork = $data['bodywork'];
                $sanding = $data['sanding'];

                $a_top = $data['a_top'];
                $b_bazel = $data['b_bazel'];
                $c_palmrest = $data['c_palmrest'];
                $d_back_cover = $data['d_back_cover'];
                $keyboard = $data['keyboard'];
                $lcd = $data['lcd'];
                $webcam = $data['webcam'];
                $mousepad_button = $data['mousepad_button'];
                $mic = $data['mic'];
                $speaker = $data['speaker'];
                $wi_fi_connection = $data['wi_fi_connection'];
                $ram = $data['ram'];
                $hdd_boot = $data['hard_disk_boot'];
                $usb = $data['usb'];
                $battery = $data['battery'];
                $hinges_cover = $data['hinges_cover'];
                $qr_number = $data['qr_number'];
                $qc_paper_id = $data['qc_paper_id'];
                $reject_person = 0;
                $rejection_department = 0;
                
                if ($lcd == 'reject') {
                    

                    $query = "SELECT user_id FROM performance_record_table WHERE qr_number='$qr_number' AND department_id='10' AND job_description='Install LCD'";
                    $query_run = mysqli_query($connection, $query);
                    if(empty($query_run)){}else{

                    foreach ($query_run as $data) {
                        echo "pakaya";
                        $reject_person = $data['user_id'];
                        $rejection_department = 10;
                    }
                }
                    if ($reject_person == 0) {
                        $query = "SELECT user_id FROM performance_record_table WHERE qr_number='$qr_number' AND department_id='1' AND (job_description='Put RAM + Hard Disk + Test' OR job_description='Combine+ Test')";
                        $query_run = mysqli_query($connection, $query);

                        foreach ($query_run as $data) {
                            $reject_person = $data['user_id'];
                            $rejection_department = 1;
                        }
                       
                    }
                }
                elseif (
                    $bios_lock_hp != 'ok' || $bios_lock_dell != 'ok' || $bios_lock_lenovo != 'ok' || $bios_lock_other != 'ok' || $computrace_hp != 'inactive' ||
                    $computrace_dell != 'deactivate' || $computrace_lenovo != 'ok' || $computrace_other != 'ok' || $me_region_lock_hp != 'ok' || $tpm_lock_dell != 'ok' ||
                    $other_error_lenovo != 'no_have' || $other_error_other_brand != 'no_have'
                ) {
                   
                   
                    $query = "SELECT user_id FROM performance_record_table WHERE qr_number='$qr_number' AND department_id='9' ORDER BY performance_id DESC LIMIT 1";
                    $query_run = mysqli_query($connection, $query);
                    if(empty($query_run)){}else{
                        
                    foreach ($query_run as $data) {
                        $reject_person = $data['user_id'];
                        $rejection_department = 9;
                    }
                }
                    if ($reject_person == 0) {
                        $query = "SELECT user_id FROM performance_record_table WHERE qr_number='$qr_number' AND department_id='1'AND (job_description='Put RAM + Hard Disk + Test' OR job_description='Combine+ Test')";
                        $query_run = mysqli_query($connection, $query);

                        foreach ($query_run as $data) {
                            $reject_person = $data['user_id'];
                            $rejection_department = 1;
                        }
                    }
                }
                elseif (
                    $bios_lock_hp != 'ok' || $bios_lock_dell != 'ok' || $bios_lock_lenovo != 'ok' || $bios_lock_other != 'ok' || $computrace_hp != 'inactive' ||
                    $computrace_dell != 'deactivate' || $computrace_lenovo != 'ok' || $computrace_other != 'ok' || $me_region_lock_hp != 'ok' || $tpm_lock_dell != 'ok' ||
                    $other_error_lenovo != 'no_have' || $other_error_other_brand != 'no_have' || $a_top != 'ok' || $lcd != 'ok' || $b_bazel != 'ok' || $no_power != 'ok' || $no_display != 'ok' || $other_issue != 'no_have' || $c_palmrest != 'ok' || $d_back_cover != 'ok' ||
                    $keyboard != 'ok' || $webcam != 'ok' || $mousepad_button != 'ok' || $mic != 'ok' || $speaker != 'ok' || $wi_fi_connection != 'ok' ||
                    $usb != 'ok' || $battery == 'bad' || $ram != 'match' || $hdd_boot != 'ok' || $hinges_cover != 'ok' 
                ) {

                    $query = "SELECT user_id FROM performance_record_table WHERE qr_number='$qr_number' AND department_id='1' AND (job_description='Put RAM + Hard Disk + Test' OR job_description='Combine+ Test') LIMIT 1";
                    $query_run = mysqli_query($connection, $query);

                    foreach ($query_run as $data) {
                        $reject_person = $data['user_id'];
                        $rejection_department = 1;
                    }
                }
                elseif( $bodywork != 'ok' || $sanding != 'ok'){
                     $query = "SELECT user_id FROM performance_record_table WHERE qr_number='$qr_number' AND department_id='7' ORDER BY performance_id DESC LIMIT 1";
                    $query_run = mysqli_query($connection, $query);
                    foreach ($query_run as $data) {
                        $reject_person = $data['user_id'];
                        $rejection_department = 7;
                    }
                   
                }
                 $sql="UPDATE qc_paper  SET  reject_person='$reject_person',rejection_department='$rejection_department' WHERE qc_paper_id='$qc_paper_id'";
                $sql_run =mysqli_query($connection,$sql);
                 echo ++$i;
                echo $sql;
                echo "</br>";
                

}
?>