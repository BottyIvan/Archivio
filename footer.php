<footer class="navBottom">
    <nav>
        <span class="navItem linkItem <?if($page=="index") echo "activeNav";?>"  data-link="<?=INDEX?>">
            <i class="fas fa-folder-minus"></i>
        </span>
        <span class="navItem linkItem <?if($page=="add_item") echo "activeNav";?>" data-link="<?=INDEX?>/include/add_item.php">
            <i class="fas fa-plus-circle"></i>
        </span>
        <span class="navItem linkItem <?if($page=="settings") echo "activeNav";?>" data-link="<?=INDEX?>/include/settings.php">
            <i class="fas fa-cog"></i>
        </span>
        <span class="navItem linkItem <?if($page=="logout") echo "activeNav";?>" data-link="<?=INDEX?>/logout.php">
            <i class="fas fa-sign-out-alt"></i>
        </span>
    </nav>
</footer>
<?php $conn->close(); ?>