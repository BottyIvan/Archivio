<?
session_start();

$user_check = $_SESSION['login_user'];
$ses_sql = mysqli_query($conn,"select username from admin where username = '$user_check' ");   
$row_admin = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);   
$login_session = $row_admin['username'];

if(!isset($_SESSION['login_user'])) {
    if(dirname($_SERVER['SCRIPT_NAME'])=="/archivio/include") header("location: ../login.php");
    else header("location: ".INDEX."/login.php");
}

?>