<?
require_once("pref/DIR.php");
require_once("CORE/conn.php");
require_once("session.php");
if($_REQUEST['init']==1){
    $search = '%';
    $typeFilter = '%';
    $available = 'true';
	$bucket = '%';
} elseif(isset($_REQUEST['search'])) {
    $search = $_REQUEST["search"];
    $typeFilter = $_SESSION["typeFilter"];
    $available = 'true';
	$bucket = $_SESSION['bucket'];
} elseif(isset($_REQUEST['typeFilter'])) {
    $search = $_SESSION["search"];
    $typeFilter = $_REQUEST["typeFilter"];
    $available = 'true';
	$bucket = $_SESSION['bucket'];
}  elseif(isset($_REQUEST['available'])) {
    $search = $_SESSION["search"];
    $typeFilter = $_SESSION["typeFilter"];
    $available = 'false';
	$bucket = $_SESSION['bucket'];
} elseif(isset($_REQUEST['bucket'])){
    $search = $_SESSION["search"];
    $typeFilter = $_SESSION['typeFilter'];
    $available = 'false';
	$bucket = $_REQUEST['bucket'];
} else {
    $search = $_SESSION["search"];
    $typeFilter = $_SESSION["typeFilter"];
    $available = 'true';
	$bucket = '%';
}

$username = $_COOKIE["username"];

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

$_SESSION['search'] = $search;
$_SESSION['typeFilter'] = $typeFilter;
$_SESSION['bucket'] = $bucket;
setcookie("color_pref",$color, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie("pref_lang",$lang, time() + (86400 * 30), "/"); // 86400 = 1 day

include("CORE/strings.php");

$page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
if($bucket=="s") $page = $page."/?bucket=s";

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
        <meta name="author" content="ivanbotty.cloud">
        <meta name="application-name" content="An easy archive.">
        <link rel="manifest" href="manifest.json">
        <link rel="icon" href="images/icons/icon-384x384.png">
        <!-- apple ios app -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="default" />
        <link rel="apple-touch-icon" href="images/icons/icon-384x384.png">
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
    <?
    $query = "SELECT * FROM archive WHERE available='$available' AND (name LIKE '%$search%' OR id LIKE '%$search%') AND type LIKE '%$typeFilter%' AND bucket LIKE '%$bucket%' ORDER BY id DESC";
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
					case "index/?bucket=s":
						echo "Bucket";
						break;
                    case "add_item":
                        echo $stringAddItem;
                        break;
                    case "settings":
                        echo ucfirst($page);
                        break;
                }
            }?>
        </header>