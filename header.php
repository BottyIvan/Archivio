<?
include("pref/DIR.php");
include("CORE/conn.php");
include("session.php");
if($_REQUEST['init']==1){
    $search = "%";
    $typeFilter = "%";
} elseif(isset($_REQUEST['search'])) {
    $search = $_REQUEST["search"];
    $typeFilter = $_SESSION["typeFilter"];
} elseif(isset($_REQUEST['typeFilter'])) {
    $search = $_SESSION["search"];
    $typeFilter = $_REQUEST["typeFilter"];
} else {
    $search = $_SESSION["search"];
    $typeFilter = $_SESSION["typeFilter"];
}

if(is_null($_REQUEST["lang"]) AND !isset($_COOKIE["pref_lang"]))
    $lang = "eng";
else if($_REQUEST["lang"])
    $lang = $_REQUEST["lang"]; 
else
    $lang = $_COOKIE["pref_lang"];

if(is_null($_REQUEST["color_pref"]) AND !isset($_COOKIE["color_pref"]))
    $color = "pink";
else if($_REQUEST["color_pref"])
    $color = $_REQUEST["color_pref"]; 
else
    $color = $_COOKIE["color_pref"];

$_SESSION["search"] = $search;
$_SESSION["typeFilter"] = $typeFilter;
setcookie("color_pref",$color, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie("pref_lang",$lang, time() + (86400 * 30), "/"); // 86400 = 1 day

include("CORE/strings.php");

$page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);

if($_SESSION["debug"]=="true" OR $_REQUEST["debug"]=="true"){
    echo "linguage: ".$lang."<br>";
    echo "search : ".$search."<br>";
    echo "type filter: ".$typeFilter;
    $_SESSION["debug"]=="true";
}
?>
<html lang="it-IT">
    <head>
        <title><?=$page?></title>
        <meta charset="utf-8">
        <!-- apple ios app -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="default" />
        <link rel="apple-touch-icon" href="icons/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="icons/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="180x180" href="icons/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="167x167" href="icons/touch-icon-ipad-retina.png">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,shrink-to-fit=no">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="<?=CSS_DIR?>/style.css" rel="stylesheet" media="all">
        <link href="<?=CSS_DIR?>/resp.css" rel="stylesheet" media="all">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="<?=JS_DIR?>/main.js" type="text/javascript"></script>
    </head>
    <?
    $query = "SELECT * FROM archive WHERE available='true' AND name LIKE '%$search%' AND type LIKE '%$typeFilter%' ORDER BY id DESC";
    $result = $conn->query($query);
    ?>
    <body <?="class=\"$color\""?>>
        <header class="header">
            <?if($page=="index"){?>
                <form class="formSearch" method="post" action="?init=2">
                    <input type="text" class="inputSearch" name="search" placeholder="<?=$stringSearch?>" value="<?if($search!="%") echo $search;?>">
                    <button class="btnSearch" name="btnSearch">
                        <span>
                            <i class="fas fa-search"></i>
                        </span>
                    </button>
                </form>
            <?} else {
                switch ($page){
                    case "add_item":
                        echo $stringAddItem;
                        break;
                    case "settings":
                        echo ucfirst($page);
                        break;
                }
            }?>
        </header>