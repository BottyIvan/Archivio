<? include ("../header.php");?>
<section class="main">
    <form method="post" action="../CORE/sql.php?operation=add" id="addItemForm" name="addItemForm">
        <div class="row">
            <input type="text" class="input" name="name" placeholder="<?=$stringName?>">
        </div>
        <div class="row">
            <select class="inputSelect" name="type">
                <option><?=$stringType?></option>
                 <?
                    $filter = "SELECT * FROM archive_type ORDER BY name ASC";
                    $rsFilter= $conn->query($filter);
                   if ($rsFilter->num_rows > 0) {
                        while($row = $rsFilter->fetch_assoc()) {?>
                                <option value="<?=$row['name']?>"><?=$row['name']?></option>
                        <?
                        }
                    }
                    ?>
            </select>
        </div>
        <div class="row">
            <input type="number" class="input" name="quantity" placeholder="<?=$stringQuantity?>">
        </div>
        <div class="row">
            <input type="number" class="input" name="priority" placeholder="<?=$stringPriority?>">
        </div>
        <div class="row">
            <input type="number" class="input" name="length" placeholder="<?=$stringLength?>">
        </div>
        <div class="row">
            <input type="number" class="input" name="high" placeholder="<?=$stringHigh?>">
        </div>
        <div class="row">
            <input type="number" class="input" name="width" placeholder="<?=$stringWidth?>">
        </div>
        <div class="row">
            <input type="number" class="input" name="depth" placeholder="<?=$stringDepth?>">
        </div>
        <div class="row">
            <input type="text" class="input" name="color" placeholder="<?=$stringColor?>">
        </div>
        <div class="row">
            <input type="text" class="input" name="material" placeholder="<?=$stringMaterial?>">
        </div>
        <div class="row">
            <input type="text" class="input" name="position" placeholder="<?=$stringPosition?>">
        </div>
        <div class="row">
            <input type="text" class="input" name="description" placeholder="<?=$stringDescription?>">
        </div>
    </form>
    <button class="btnSubmit" type="button" onclick="document.addItemForm.submit();">
        <i class="fas fa-save"></i>&nbsp;<?=$stringBtnSubmit?>
    </button>
</section>
<? include ("../footer.php");?>