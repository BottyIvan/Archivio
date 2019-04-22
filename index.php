<? require_once ("header.php");?>
<div class="filterSelector">
    <ul class="listFilter">
    <?
    $filter = "SELECT * FROM archive_type ORDER BY name ASC";
    $rsFilter= $conn->query($filter);
    if($typeFilter!="%" OR $search!="%") { ?>
        <li class="linkItem listFilterClear" data-link="?init=1"><i class="fas fa-times"></i></li>
    <?
    }
    if ($rsFilter->num_rows > 0) {
        while($row = $rsFilter->fetch_assoc()) {?>
            <li class="linkItem <?if($typeFilter==$row['name']) echo "listFilterActive";?>" data-link="?typeFilter=<?=$row['name']?>"><?=$row['name']?></li>
        <?
        }
    }
    ?>
    </ul>
</div>
<section class="main">
<? include("include/home.php")?>
</section>
<? require_once ("footer.php");?>