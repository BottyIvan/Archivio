<? include ("header.php");?>
<div class="filterSelector">
    <ul class="listFilter">
    <?
    $filter = "SELECT * FROM archive_type ORDER BY name ASC";
    $rsFilter= $conn->query($filter);
    if($typeFilter!="%") { ?>
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
    <?
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $last_id = $row["id"];
            ?>
            <div class="row openView" data-link="<?="include/item.php?id=".$row["id"]?>">
                <div>
                    <span class="nameItem fullText"><?=$row["name"]?></span>
                    <br>
                    <span class="descItem fullText"><?=$row["description"]?></span>
                </div>
                <span class="quantityItem"><span><?=$row["quantity"]?></span></span>
            </div>
    <?}
    } else { ?>
      <span class="sad"><i class="fas fa-frown"></i><br><?=$noItem?></span>
    <?
    }
    ?>
</section>
<? include ("footer.php");?>