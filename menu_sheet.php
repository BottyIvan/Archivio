<?
include("pref/DIR.php"); 
include("CORE/strings.php");
?>
<section class="main">
    <div class="rowOptGroup">
        <i class="fas fa-user-circle"></i>
        <button class="rowOpt" onclick="location.href='<?=INDEX?>/include/user.php'">
            <?=$stringOptUser?>
        </button>
    </div>
    <div class="rowOptGroup">
        <i class="fas fa-sign-out-alt"></i>
        <button class="rowOpt" onclick="location.href='<?=INDEX?>/logout.php'">
            logout
        </button>
    </div>
</section>