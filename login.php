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
        <!-- apple ios app -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="default" />
        <link rel="apple-touch-icon" href="http://www.thomasmaneggia.it/Favicon.png" />
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,shrink-to-fit=no">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="<?=CSS_DIR?>/style.css" rel="stylesheet" media="all">
        <link href="<?=CSS_DIR?>/resp.css" rel="stylesheet" media="all">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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