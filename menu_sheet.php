<?
require_once("pref/DIR.php"); 
require_once("CORE/conn.php");
require_once("session.php");
require_once("CORE/strings.php");
?>
<section class="main">
    <div class="rowOptGroup" onclick="location.href='<?=INDEX?>/include/user.php'">
		<div class="rowOpt">
			<i class="fas fa-user-circle"></i>
			<div><?=$_SESSION['login_user']?></div>
		</div>
    </div>
    <div class="rowOptGroup" onclick="location.href='<?=INDEX?>/logout.php'">
		<div class="rowOpt">
			<i class="fas fa-sign-out-alt"></i>
			<div>logout</div>
		</div>
    </div>
</section>