<?php
include_once '../../dataAccess/connection.php';
include_once '../../dataAccess/functions.php';
include_once '../../dataAccess/403.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>AL SAKB</title>
    <link rel="stylesheet" href="../../static/plugins/fontawesome-pro/css/all.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../static/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../../static/dist/css/adminlte.css">

    <!-- Customer CSS -->
    <link rel="stylesheet" href="../../static/dist/css/style.css">
    <style>
    p {
        width: 2000px;
        height: 100px;
        /* position: relative; */
        animation: mymove 40s;
        /* animation-fill-mode: backwards; */
    }

    @keyframes mymove {
        from {
            top: 900px;
        }

        to {
            top: -3000px;
        }
    }
    </style>
    <?php header("refresh: 40")  ?>
</head>

<body>
    <div>
        <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <?php
  $date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
    $day_start = date("Y-m-d 00:00:00");
    $day_end = date("Y-m-d 23:59:00");


$sql="SELECT job_description, COUNT(qr_number) AS qr_number, performance_record_table.user_id, full_name, username FROM performance_record_table 
LEFT JOIN users ON users.user_id = performance_record_table.user_id 
LEFT JOIN employees ON employees.emp_id = users.epf WHERE end_time BETWEEN '$day_start' AND '$day_end' GROUP BY performance_record_table.user_id,job_description;";
$sql_query=mysqli_query($connection,$sql);
$details = [];
$details2 = [];
$arr = [];
$uName=0;
   $a=0;
    $target='0';
                                        $total_target='1';
                                        $count='0';
                                        $average =0;
                                        $id=0;
foreach($sql_query as $deta){
    $user_id = $deta['user_id'];
     $username = $deta['username'];
     $name = $deta['full_name'];
     $qty=$deta['qr_number'];
     
//    echo  $data['user_id'];
//    echo  "-".$data['full_name']." -";
//    $sql1="SELECT job_description,COUNT(qr_number) AS qr_number FROM performance_record_table WHERE user_id ='$user_id' AND end_time BETWEEN '$day_start' AND '$day_end' ";
// $sql_query1=mysqli_query($connection,$sql1);
 
// foreach($sql_query1 as $deta){
    
      $job_description=$deta['job_description'];
                                        if($job_description=='BIOS Lock Low Gen'){
                                           $target='1.66';
                                            $total_target='100';
                                            $count='60';
                                        }elseif($job_description =='BIOS Lock High Gen'){
                                            $target='1.66';
                                            $total_target='100';
                                             $count='60'; $count='50';
                                        }elseif($job_description=='No Power / No Display / Account Lock/ Ports Issue'){
                                            $target='4';
                                            $total_target='100';
                                             $count='25'; 
                                        }elseif($job_description=='Unlock'){
                                            $target='0.66';
                                            $total_target='100';
                                             $count='150';
                                        }elseif($job_description=='Chargin'){
                                            $target='0.66';
                                            $total_target='100';
                                             $count='150'; 
                                        }elseif($job_description=='Openning Battery And Cell Change'){
                                            $target='2';
                                            $total_target='100';
                                             $count='50';
                                        }elseif($job_description=='store to lcd rack'){
                                            $target='0.5';
                                            $total_target='100'; $count='200';
                                        }elseif($job_description=='store to bodywork rack'){
                                            $target='0.5';
                                            $total_target='100'; $count='200';
                                        }elseif($job_description=='store to motherboard rack'){
                                            $target='0.5';
                                            $total_target='100'; $count='200';
                                        }elseif($job_description=='Remove LCD'){
                                            $target='0.83';
                                            $total_target='100'; $count='120';
                                        }elseif($job_description=='Install LCD'){
                                            $target='0.83';
                                            $total_target='100'; $count='120';
                                        }elseif($job_description=='Fixed Lcd'){
                                            $target='3.33';
                                            $total_target='100'; $count='30';
                                        }elseif($job_description=='Remove Polization Film'){
                                            $target='0.83';
                                            $total_target='100'; $count='120';
                                        }elseif($job_description=='Clean+Glue+Install Polization Film'){
                                            $target='1.66';
                                            $total_target='100'; $count='60';
                                        }elseif($job_description=='send to production'){
                                            $target='0.5';
                                            $total_target='100'; $count='200';
                                        }elseif($job_description=='pc scan'){
                                            $target='0.4';
                                            $total_target='100'; $count='500';
                                        }elseif($job_description=='Low Generation Function Test'){
                                            $target='0.5';
                                            $total_target='100'; $count='200';
                                        }elseif($job_description=='High Generation Function Test'){
                                            $target='0.5';
                                            $total_target='100'; $count='200';
                                        }elseif($job_description=='High Generation Function Test + MFG'){
                                            $target='1';
                                            $total_target='100'; $count='100';
                                        }elseif($job_description=='Windows Instalation'){
                                            $target='1.44';
                                            $total_target='100'; $count='70';
                                        }elseif($job_description=='Combine'){
                                            $target='1.66';
                                            $total_target='100'; $count='60';
                                        }elseif($job_description=='Hard Disk Copy'){
                                            $target='0.25';
                                            $total_target='100'; $count='400';
                                        }elseif($job_description=='Put RAM + Hard Disk + Test'){
                                            $target='2';
                                            $total_target='100'; $count='50';
                                        }elseif($job_description=='Combine+ Test'){
                                            $target='2';
                                            $total_target='100'; $count='50';
                                        }elseif($job_description=='Clean'){
                                            $target='1.66';
                                            $total_target='100'; $count='60';
                                        }elseif($job_description=='Packing'){
                                            $target='0.5';
                                            $total_target='100'; $count='200';
                                        }elseif($job_description=='Full Painting Packing'){
                                            $target='1.66';
                                            $total_target='100'; $count='60';
                                        }elseif($job_description=='Sanding'){
                                            $target='1.66';
                                            $total_target='100'; $count='60';
                                        }elseif($job_description=='Bodywork'){
                                            $target='2.5';
                                            $total_target='100'; $count='40';
                                        }elseif($job_description=='Taping'){
                                            $target='1.66';
                                            $total_target='100'; $count='60';
                                        }elseif($job_description=='Low Generation'){
                                            $target='0.5';
                                            $total_target='100'; $count='200';
                                        }elseif($job_description=='Full Painting'){
                                            $target='2';
                                            $total_target='100'; $count='50';
                                        }elseif($job_description=='Keyboard Lacker'){
                                            $target='0.2';
                                            $total_target='100'; $count='500';
                                        }elseif($job_description=='A panel paint'){
                                            $target='0.5';
                                            $total_target='100'; $count='200';
                                        }elseif($job_description=='Designing + Pasting'){
                                            $target='5';
                                            $total_target='100'; $count='20';
                                        }elseif($job_description=='Cleaning'){
                                            $target='1.66';
                                            $total_target='100'; $count='60';
                                        }elseif($job_description=='Pasting'){
                                            $target='0.66';
                                            $total_target='100';$count='150';
                                          ///////////////////////////////////////////////////////////////////////
                                        }elseif($job_description=='Low Gen bodywork+sanding+taping'){
                                            $target='2.5';
                                            $total_target='100';$count='40';
                                        }elseif($job_description=='High Gen bodywork+sanding+taping'){
                                            $target='3.33';
                                            $total_target='100';$count='30';
                                        }elseif($job_description=='bodywork+sanding'){
                                            $target='2.5';
                                            $total_target='100';$count='40';
                                        }elseif($job_description=='bodywork+sanding+taping'){
                                            $target='3.33';
                                            $total_target='100';$count='30';
                                            ////////////////////////////////////////////////////////////
                                        }elseif($job_description=='Inventory Testing Lenovo'){
                                            $target='1.25';
                                            $total_target='100';$count='80';
                                        }elseif($job_description=='Inventory Testing Dell'){
                                            $target='1';
                                            $total_target='100';$count='100';
                                        }elseif($job_description=='Inventory Testing HP'){
                                            $target='1.25';
                                            $total_target='100';$count='80';
                                        }
                                        
                                         $total= $qty * $target;
                                        $id= count($details);
                                         
                                          if($uName != $user_id){
                                              
                                                 $average =  $total ;
                                                $all=$username."-".$name."-".$total;
                                                 $details[$a++]= $all;
                                            }elseif($uName == $user_id){
                                                if($uName !=0){
                                                      $id = $id-1;
                                                }
                                                 $average =  $average + $total ;
                                                  $all=$username."-".$name."-".$average;
                                                   
                                                   $id=  $id - 1;
                                                  $details[$id]= "$all";
                                               
                                                  
                                            }
                                             $uName = $user_id;
                                           
                                       
                                        // $details[]= "$name";
                                        // $details[]= "$average";
}
$i=0;

foreach($details as $key => $value) {
        $i++;
              $data = explode('-', $value);
                   $levels = array($data[2]);
                   $attributes = array( $data[0],  $data[1],  $data[2]);
                   foreach ($levels as $key => $level){
       foreach ($attributes as $k =>$attribute){
             $arrayVariables[$level][] = $attribute ; // changed $arrayVariables[] to $arrayVariables[$level][]
       }
    }
usort($arrayVariables, fn($a, $b) => $b['2'] <=> $a['2']);
 }
///////////////////////////////////////////////////////////
       
        --$i;
        $king=0;
        
for ($row = 0; $row < $i; $row++) {
  for ($col = 0; $col < 1; $col++) {
    if($king ==0){ ?>
        <p style="font-size: 36px;" class="card-body bg-success  card w-75">
            <?php echo $arrayVariables[$row][0]."  -  ".$arrayVariables[$row][1]." ".$arrayVariables[$row][2]."%";
               ?>
        </p>
        <?php }else{
    ?>
        <p style="font-size: 36px;" class="card-body bg-success  card w-75">
            <?php echo $king."---".$arrayVariables[$row][0]."  -  ".$arrayVariables[$row][1]." ".$arrayVariables[$row][2]."%";
                ?>
        </p>
        <?php

  }
  $king++;
}

  echo "</br>";
}
?>

    </div>
</body>