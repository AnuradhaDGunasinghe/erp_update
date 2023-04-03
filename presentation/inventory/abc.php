<?php
session_start();
include_once '../../dataAccess/connection.php';
include_once '../../dataAccess/functions.php';
include_once '../../dataAccess/403.php';
include_once '../includes/header.php';
?>
<form method='POST'>
    <div class=" row">
        <label class="col-sm-4 col-form-label">Search By Model</label>
        <div class="col-sm-4">
            <input class="w-200" style="color:black !important" type="text" name="search_value"
                placeholder="Enter Model here">
        </div>
    </div>
    <button type="submit" name="submit" id="submit" class="btn btn-default bg-gradient-success btn-next d-none">
    </button>
</form>
<?php
$search_value = 0;
if (isset($_POST['submit'])) {
    $search_value = $_POST['search_value'];
    // $query = "SELECT * FROM warehouse_information_sheet WHERE inventory_id='$search_value' ";
    // $query_run = mysqli_query($connection, $query);
    // // header('Location: temporary.php');
}

// if (isset($_POST['submit1'])) {
//     $search_value1 = $_POST['id'];
//     $mfg = $_POST['mfg'];
//     $query = "DELETE FROM `warehouse_information_sheet` WHERE `inventory_id`='$search_value1'";
//     $query_run = mysqli_query($connection, $query);
//     $query = "UPDATE machine_from_supplier SET add_to_wis ='0' WHERE mfg='$mfg'";
//     $query_run = mysqli_query($connection, $query);
// }

?>
<div class="col-lg-12 grid-margin stretch-card justify-content-center mx-auto ">
    <div class="card mt-3">
        <div class="card-header" style="font-size:18px">

        </div>
        <div class="card-body">
            <div class="row">
                <?php
$rowcount = 0;
$query = "SELECT inventory_id,start_time,user_id FROM warehouse_information_sheet
            LEFT JOIN performance_record_table ON performance_record_table.qr_number=warehouse_information_sheet.inventory_id
  WHERE warehouse_information_sheet.model like '%$search_value%' AND warehouse_information_sheet.send_to_production='1'  GROUP BY inventory_id ORDER BY performance_record_table.start_time ASC ";
$query_run = mysqli_query($connection, $query);

    ?>
                <table id="tblexportData" class="table table-striped">
                    <thead>

                        <th>ALSAKB QR CODE</th>
                        <th>send to prod date</th>
                        <th>send to prod user</th>
                        <th>Last scaned Department</th>
                        <th>Last scaned user</th>
                        <th>Last scaned date</th>


                    </thead>
                    <tbody>
                        <?php
foreach ($query_run as $data) {
        $inventory_id = $data['inventory_id'];
        $start_time = $data['start_time'];
        $user_id = $data['user_id'];
        $department =0;
        $start_date = 0;
        $username = 0;
        // $sql="SELECT departments.department,start_time,full_name FROM performance_record_table 
        // LEFT JOIN users ON users.user_id=performance_record_table.user_id 
        // LEFT JOIN employees ON employees.emp_id=users.epf 
        // LEFT JOIN departments ON departments.department_id=performance_record_table.department_id
        // WHERE qr_number='$inventory_id' ORDER BY start_time DESC LIMIT 1";
        // $sql_run=mysqli_query($connection,$sql);
        // foreach($sql_run as $run){
        // $department = $run['department'];
        // $start_date = $run['start_time'];
        // $username = $run['full_name'];
        // }
        ?><tr>
                            <td><?php echo $inventory_id; ?></td>
                            <td><?php echo $start_time ?></td>
                            <td><?php echo $user_id; ?></td>
                            <td><?php echo $department; ?></td>
                            <td><?php echo $username; ?></td>
                            <td><?php echo $start_date ?></td>


                        </tr>
                        <?php
}
    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>