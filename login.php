<?
include("pref/DIR.php");
include("CORE/conn.php");
session_start();

$username = $_COOKIE["username"];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form
    $myusername = mysqli_real_escape_string($conn,$_REQUEST['user']);
    $mypassword = mysqli_real_escape_string($conn,md5($_REQUEST['psw'])); 
    $sql = "SELECT * FROM admin WHERE username = '$myusername' and passcode = '$mypassword'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];
    
    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count == 1) {
        $_SESSION['login_user'] = $myusername;
        header("location: ".INDEX."/?init=1");
    }else {
        $error = "Your Login Name or Password is invalid";
    }
}

?>
<html lang="it-IT">
    <head>
        <title><?=$page?></title>
        <meta charset="utf-8">
        <meta name="author" content="ivanbotty.cloud">
        <meta name="application-name" content="An easy archive.">
        <link rel="manifest" href="manifest.json">
        <link rel="icon" href="images/icons/icon-384x384.png">
        <!-- apple ios app -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="default" />
        <link rel="apple-touch-icon" href="touch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="152x152" href="images/icons/icon-384x384.png">
        <link rel="apple-touch-icon" sizes="180x180" href="images/icons/icon-384x384.png">
        <link rel="apple-touch-icon" sizes="167x167" href="images/icons/icon-384x384.png">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,shrink-to-fit=no">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="<?=CSS_DIR?>/style.css" rel="stylesheet" media="all">
        <link href="<?=CSS_DIR?>/resp.css" rel="stylesheet" media="all">
        <link href="<?=CSS_DIR?>/colors.css" rel="stylesheet" media="all">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="<?=JS_DIR?>/main.js" type="text/javascript"></script>
    </head>
    <body>
        <section class="main">
            <div class="rowOptGroup">
                <div class="rowOpt">
                    <div>
                        <form id="ui_log" action="" method="post">
                            <?
                            $query = "SELECT photo FROM admin WHERE username LIKE '".$username."'";
                            $result = $conn->query($query);
                            $row = $result->fetch_assoc();
                            ?>
                            <div>
                                <? if($result->num_rows>0){?>
                                <div class="userIconFull" style="background: url(<?=INDEX."/user/".$row['photo']?>)"></div>
                                <? } else {?>
                                <div class="userIconFull" style="background: url(<?=INDEX."default_user.png"?>)"></div>
                                <?}?>
                            </div>
                            <div>
                                <input type="text" name="user" placeholder="username">
                            </div>
                            <div>
                                <input type="password" name="psw" placeholder="password">
                            </div>
                            <button class="btnSubmit" type="submit">
                                <i class="fas fa-sign-in-alt"></i>&nbsp;Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>