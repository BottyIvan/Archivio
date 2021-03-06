<section class="view">
    <div class="closeViewArea"></div>
    <div class="mainView hidden"></div>
</section>
<footer class="navBottom">
    <?
    $userQuery = "SELECT * FROM admin WHERE username LIKE '".$_SESSION['login_user']."'";
    $userResult = $conn->query($userQuery);
	$user = $userResult->fetch_assoc();
    ?>
    <nav>
        <span class="navItem linkItem <?if($page=="index") echo "activeNav";?>"  data-link="<?=INDEX?>">
            <i class="fas fa-folder-minus"></i>
        </span>
        <span class="navItem linkItem <?if($page=="index/?basket=s") echo "activeNav";?>"  data-link="<?=INDEX?>/?basket=s">
            <i class="fas fa-shopping-cart"></i>
        </span>
		<? if($user["role"]!="user") {?>
        <span class="navItem linkItem <?if($page=="add_item") echo "activeNav";?>" data-link="<?=INDEX?>/include/add_item.php">
            <i class="fas fa-plus-circle"></i>
        </span>
		<?}?>
        <span class="navItem linkItem <?if($page=="settings") echo "activeNav";?>" data-link="<?=INDEX?>/include/settings.php">
            <i class="fas fa-cog"></i>
        </span>
        <?
	    $photoQuery = "SELECT * FROM admin WHERE username LIKE '".$_SESSION['login_user']."'";
    	$photoResult = $conn->query($photoQuery);
        if ($photoResult->num_rows > 0) {
            $photo = $photoResult->fetch_assoc();
            ?>
            <span class="navItem userIcon openViewOption <?if($page=="logout") echo "activeNav";?>" style="background: url(<?=INDEX."/user/".$photo['photo']?>)" data-link="<?=INDEX?>/menu_sheet.php">
            </span>
        <?}?>
    </nav>
</footer>
<?php $conn->close(); ?>
</body>
</html>