<?php 
session_start();
include_once('../../dataAccess/connection.php');
include_once('../../dataAccess/functions.php');
include_once('../../dataAccess/403.php');
include_once('../includes/header.php');
// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
} 
?>
<form action="" method="POST">
    <div class="row w-50">
        <div class="col-md-4">
            <div class="form-group">
                <input type="datetime-local" name="from_date"
                    value="<?php if (isset($_POST['from_date'])) {echo $_POST['from_date'];}?>" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="datetime-local" name="to_date"
                    value="<?php if (isset($_POST['to_date'])) {echo $_POST['to_date'];}?>" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <button type="submit" class="btn btn-xs btn-primary px-3"
                    style=" font-size: 10px; margin-top: 4px; border-radius: 7px; letter-spacing: 1px;">Search
                    Date</button>
            </div>
        </div>
    </div>
</form>

<div class="col col-lg-12 justify-content-center m-auto text-uppercase">
    <div class="row">
        <div class="col-lg-11 grid-margin stretch-card justify-content-center mx-auto mt-2">
            <div class="card mt-3">
                <div class="card-body">

                    <h1> Name : <?php $emp_id = $_SESSION['epf'];
                                $query = "SELECT full_name FROM employees WHERE emp_id ='$emp_id'";
                                $query_run = mysqli_query($connection, $query);
                                $name;
                                foreach ($query_run as $data) {
                                    echo $data['full_name'];
                                    $name=$data['full_name'];
                                } ?><br>
                        EmpID :<?php echo $_SESSION['epf'] ?><br>
                        Department :
                        <?php $department_id = $_SESSION['department'];
                        $user_id = $_SESSION['user_id'];
                        $query = "SELECT department FROM departments WHERE department_id='$department_id'";
                        $query_run = mysqli_query($connection, $query);
                        $i=0;
                        foreach ($query_run as $data) {
                            echo $data['department'];
                        }
                        
                        ?>
                    </h1>
                    <button onclick="exportToExcel('tblexportData', '<?php echo $name;?>')"
                        class="btn bg-gradient-success mt-3">Export Table Data To Excel
                        File</button>
                    <table id="tblexportData" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date Time</th>
                                <th>Reject QR Number</th>
                                <th>Reject Model</th>
                                <th>Reject Reason</th>
                                <th>Technician User Id</th>
                                <th>Technician Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 if (isset($_POST['from_date']) && isset($_POST['to_date'])) {

                                    $from_date = $_POST['from_date'];
                                    $to_date = $_POST['to_date'];
                                }
                                if ($from_date != 0) {
                                $query = "SELECT *,qc_paper.battery as bat,username,full_name,model FROM qc_paper
                                LEFT JOIN users ON users.user_id = qc_paper.reject_person
                                LEFT JOIN employees ON employees.emp_id = users.epf
                                LEFT JOIN warehouse_information_sheet ON warehouse_information_sheet.inventory_id = qc_paper.qr_number
                                 WHERE qc_paper.user_id=$user_id AND qc_paper.status='1' AND date_time BETWEEN '$from_date' AND '$to_date'";
                                        $query_run = mysqli_query($connection, $query);
                                        $technician='';
                                        $uname='';
                                        foreach ($query_run as $data) {
                                            $i++;
                                            $bios_lock_hp = $data['bios_lock_hp'];
                                            $bios_lock_dell = $data['bios_lock_dell'];
                                            $bios_lock_lenovo = $data['bios_lock_lenovo'];
                                            $bios_lock_other = $data['bios_lock_other'];
                                            $technician=$data['full_name'];
                                            $uname=$data['username'];

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
                                            $usb = $data['usb'];
                                            $battery = $data['bat'];
                                            $hinges_cover = $data['hinges_cover'];
                                            $ram = $data['ram'];
                                            $hdd_boot = $data['hard_disk_boot'];
                                            $date_time = $data['date_time'];
                                            $qr_number=$data['qr_number'];
                                            $model=$data['model'];
                                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $date_time ?></td>
                                <td><?php echo $qr_number ?></td>
                                <td><?php echo $model ?></td>
                                <td>
                                    <?php 
                                            if ($bios_lock_hp == 'lock') {
                                                echo "Bios Lock </br>";
                                            }
                                            if ($bios_lock_dell == 'lock') {
                                                echo "Bios Lock </br>";
                                            }
                                            if ($bios_lock_lenovo == 'lock') {
                                                echo "Bios Lock</br>";
                                            }
                                            if ($bios_lock_other == 'lock') {
                                                echo "Bios Lock</br>";
                                            }
                                            if ($computrace_hp == 'active') {
                                                echo "Computrace Lock</br>";
                                            }
                                            if ($computrace_dell == 'activated' || $computrace_dell == 'disable') {
                                                echo "Computrace Lock</br>";
                                            }
                                            if ($computrace_lenovo == 'lock') {
                                                echo "Computrace Lock</br>";
                                            }
                                            if ($computrace_other == 'lock') {
                                                echo "Computrace Lock</br>";
                                            }
                                            if ($me_region_lock_hp == 'lock') {
                                                echo "ME Region Lock</br>";
                                            }
                                            if ($tpm_lock_dell == 'not ok') {
                                                echo "TPM Lock</br>";
                                            }
                                            if ($other_error_lenovo == 'have') {
                                                echo "Other Error Lenovo</br>";
                                            }
                                            if ($other_error_other_brand == 'no') {
                                                echo "Other Error</br>";
                                            }
                                            if ($no_power == 'reject') {
                                                echo "No Power</br>";
                                            }
                                            if ($no_display == 'reject') {
                                                echo "No Display Issue</br>";
                                            }
                                            if ($other_issue == 'have') {
                                                echo "Motherboard other Error</br>";
                                            }
                                            if ($a_top == 'reject') {
                                                echo "A/Top Cover(Scratch/Broken/Dent)</br>";
                                            }
                                            if ($b_bazel == 'b_bazel') {
                                                echo "B/bazel(Scratch/Brocken/Logo/Color)</br>";
                                            }
                                            if ($c_palmrest == 'reject') {
                                                echo "C/Palmrest (Scratch/Broken/Dent)</br>";
                                            }
                                            if ($d_back_cover == 'reject') {
                                                echo "D/Back Cover (Scratch/Broken/Dent)</br>";
                                            }
                                            if ($keyboard == 'reject') {
                                                echo "Keyboard(Function/ Key missing / Color)</br>";
                                            }
                                            if ($lcd == 'reject') {
                                                echo "LCD (Whitespot/Scratch/Broken/Line/Yellow shadow)</br>";
                                            }
                                            if ($webcam == 'reject') {
                                                echo "Webcam</br>";
                                            }
                                            if ($mousepad_button == 'reject') {
                                                echo "Mousepad & Button</br>";
                                            }
                                            if ($mic == 'reject') {
                                                echo "Microphone (MIC)</br>";
                                            }
                                            if ($speaker == 'reject') {
                                                echo "Speaker / Sound</br>";
                                            }
                                            if ($wi_fi_connection == 'reject') {
                                                echo "Wi-Fi Connection</br>";
                                            } 
                                            if ($usb == 'reject') {
                                                echo "USB Port</br>";
                                            }
                                            if ($battery == 'bad') {
                                                echo $battery." Battery Health</br>";
                                            }
                                            if ($hinges_cover == 'reject') {
                                                echo "Hinges Cover</br>";
                                            }
                                            if ($bodywork == 'reject') {
                                                echo "Bodywork</br>";
                                            }
                                            if ($sanding == 'reject') {
                                                echo "Sanding</br>";
                                            }
                                            if ($ram == 'not match') {
                                                echo "Ram missed match</br>";
                                            }
                                            if ($hdd_boot == 'not ok') {
                                                echo "HDD is not booting</br>";
                                            }
                                            ?>
                                </td>
                                <td><?php echo $uname ?></td>
                                <td><?php echo $technician ?></td>
                            </tr>
                            <?php 
                                        }
                                    }
                                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function exportToExcel(tableID, filename = '') {
    var downloadurl;
    var dataFileType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');

    // Specify file name
    filename = filename ? filename + '.xls' : 'export_excel_data.xls';

    // Create download link element
    downloadurl = document.createElement("a");

    document.body.appendChild(downloadurl);

    if (navigator.msSaveOrOpenBlob) {
        var blob = new Blob(['\ufeff', tableHTMLData], {
            type: dataFileType
        });
        navigator.msSaveOrOpenBlob(blob, filename);
    } else {
        // Create a link to the file
        downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;

        // Setting the file name
        downloadurl.download = filename;

        //triggering the function
        downloadurl.click();
    }
}


/////////////////////////////////////////////////////
function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("tblexportData");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>