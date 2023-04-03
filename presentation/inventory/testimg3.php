<?php 
session_start();
$username = $_SESSION['username'];
?>
<div class="box3 border" style="display: flex; justify-content: center; align-items: center;" id="printableArea">
    <div class="stikerDetails">
        <img style="width: 4.0cm;height: 2.0cm; margin-left: 0.2cm;" src="files2/<?php echo $username ?> sticker1.png">
        <br>
        <img style="width: 4.0cm;height: 2.0cm;margin-left: 0.2cm;" src="files2/<?php echo $username ?> sticker1.png">
    </div>
</div>
<script>
var int = setInterval('check()', 1000);

function check() {
    if (chobj('div') == true) {
        printDiv('printableArea')
        // window.alert('true');
        int = window.clearInterval(int);
    } else {
        // document.write('<p>false</p>');
    }
}

function chobj(printableArea) {
    return (document.getElementById('printableArea')) ? true : false;
}
document.getElementById("printableArea").innerHTML = x;

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    window.location.href = 'machine_from_supplier.php';
}
</script>