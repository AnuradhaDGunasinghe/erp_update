<?php
ob_start();
session_start();
include_once('header.php');
include_once('../../dataAccess/connection.php');
$date1 = new DateTime('now', new DateTimeZone('Asia/Dubai'));
date_default_timezone_set('Asia/Dubai');
$now = time();

// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
}
if (1684742400 < $now) {
    session_destroy();
    header("Location: ../../index.php");
}
?>

<script>
var xmlHttp;

function srvTime() {
    try {
        //FF, Opera, Safari, Chrome
        xmlHttp = new XMLHttpRequest();
    } catch (err1) {
        //IE
        try {
            xmlHttp = new ActiveXObject('Msxml2.XMLHTTP');
        } catch (err2) {
            try {
                xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
            } catch (eerr3) {
                //AJAX not supported, use CPU time.
                alert("AJAX not supported");
            }
        }
    }
    xmlHttp.open('HEAD', window.location.href.toString(), false);
    xmlHttp.setRequestHeader("Content-Type", "text/html");
    xmlHttp.send('');
    return xmlHttp.getResponseHeader("Date");
}

var st = srvTime();
var date = new Date(st);
</script>

<?php include_once('footer.php'); ?>