<?
if(substr($_SERVER[REQUEST_URI],0,18) == "/archivio/include/") {
	//require_once("../header.php");
}
require_once("../pref/DIR.php");
require_once("../CORE/conn.php");
if(!isset($search)){
    $search = "%";
}

if(is_null($_REQUEST["lang"]) AND !isset($_COOKIE["pref_lang"]))
    $lang = "eng";
else if($_REQUEST["lang"])
    $lang = $_REQUEST["lang"]; 
else
    $lang = $_COOKIE["pref_lang"];

$item = $_REQUEST["id"];

$query = "SELECT * FROM archive WHERE id = $item";
$result = $conn->query($query);
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();

require_once("../CORE/strings.php");
	
$userQuery = "SELECT * FROM admin WHERE username LIKE '".$_COOKIE["username"]."'";
$userResult = $conn->query($userQuery);
$user = $userResult->fetch_assoc();
?>
<div>
	<div class="itemViewRow toolBar">
		<span class="nameItem"><?=$row["name"]?></span>
		<span><?=$row["position"]?></span>
	</div>
	<nav class="navMenu">
		<li class="navMenuItem activeMenu" menu="view">View item</li>
		<? if($user["role"]!="user"){?>
		<li class="navMenuItem" menu="edit">Edit</li>
		<?}?>
	</nav>
	<div class="viewItem">
		<div class="itemViewRow">
			<span class="typeItem"><?=$row["type"]?></span>
			<span class="basketItem <?if($row["basket"]=="s") echo "inBasket";?>" item-id="<?=$row["id"]?>"><i class="fas fa-shopping-cart"></i>&nbsp;<?=$addBucket?></span>
		</div>
		<?
		$itemPhoto = "SELECT * FROM archive_item_image WHERE id_archive = $item";
		$rsPhoto = $conn->query($itemPhoto);?>
			<div class="itemViewRow">
				<ul class="listItemPhoto">
					<?
						while($photoRow = $rsPhoto->fetch_assoc()){?>
						<li class="listItem" id-photo="<?=$photoRow["id"]?>">
							<img src="<?=INDEX."/itemPhoto/".$photoRow["image"]?>">
						</li>
					<?}?>
					<li class="addFileBtn">
						<form action="#" id-element="<?=$row["id"]?>" method="post" enctype="multipart/form-data" id="uploadFile" name="uploadFile">
							<input type="file" class="addFile" name="itemPhoto" id="itemPhoto">
							<label for="itemPhoto">
								<i class="fas fa-plus-circle"></i>
							</label>
						</form>
					</li>
				</ul>
			</div>
		<div class="itemViewRow">
			<span><?=$stringQuantity?>&nbsp;:&nbsp;</span><span id="quantityChange"></span>
			<div class="slider" item-id="<?=$row["id"]?>" item-quantity="<?=$row["quantity"]?>"></div>
		</div>
		<? if($row["description"]!=""){?>
		<div class="itemViewRow">
			<?=$row["description"]?>
		</div>
		<?}?>
		<? if($row["quantity"]!=0){?>
		<div class="itemViewRow">
			<span><?=$stringQuantity?>&nbsp;:&nbsp;</span><?=$row["quantity"]?>
		</div>
		<?}?>
		<? if($row["id"]!=0){?>
		<div class="itemViewRow">
			<span><?=$stringCode?>&nbsp;:&nbsp;</span><?=$row["id"]?>
		</div>
		<?}?>
		<? if($row["priority"]!=0){?>
		<div class="itemViewRow">
			<span><?=$stringPriority?>&nbsp;:&nbsp;</span><?=$row["priority"]?>
		</div>
		<?}?>
		<? if($row["length"]!=0){?>
		<div class="itemViewRow">
			<span><?=$stringLength?>&nbsp;:&nbsp;</span><?=$row["length"]?>
		</div>
		<?}?>
		<? if($row["high"]!=0){?>
		<div class="itemViewRow">
			<span><?=$stringHigh?>&nbsp;:&nbsp;</span><?=$row["high"]?>
		</div>
		<?}?>
		<? if($row["width"]!=0){?>
		<div class="itemViewRow">
			<span><?=$stringWidth?>&nbsp;:&nbsp;</span><?=$row["width"]?>
		</div>
		<?}?>
		<? if($row["depth"]!=0){?>
		<div class="itemViewRow">
			<span><?=$stringDepth?>&nbsp;:&nbsp;</span><?=$row["depth"]?>
		</div>
		<?}?>
		<? if($row["color"]!=0){?>
		<div class="itemViewRow">
			<span><?=$stringColor?>&nbsp;:&nbsp;</span><?=$row["color"]?>
		</div>
		<?}?>
		<? if($row["material"]!=0){?>
		<div class="itemViewRow">
			<span><?=$stringMaterial?>&nbsp;:&nbsp;</span><?=$row["material"]?>
		</div>
		<?}?>
		<? if($row["position"]!=""){?>
		<div class="itemViewRow">
			<span><?=$stringPosition?>&nbsp;:&nbsp;</span><?=$row["position"]?>
		</div>
		<?}?>
	</div>
	<? if($user["role"]!="user"){?>
	<div class="editItem">
		<form method="post" action="#" id-element="<?=$row["id"]?>" id="editItemFrom" name="editItemFrom" enctype="multipart/form-data">
            <div class="itemViewRow">
                <span><?=$stringName?>&nbsp;:</span>
                <input type="text" class="input" name="name" placeholder="<?=$stringName?>" value="<?=$row["name"]?>">
            </div>
            <div class="itemViewRow">
                <span><?=$stringType?>&nbsp;:</span>
                <select class="inputSelect" name="type">
                    <option><?=$stringType?></option>
                     <?
                        $filter = "SELECT * FROM archive_type ORDER BY name ASC";
                        $rsFilter= $conn->query($filter);
                       if ($rsFilter->num_rows > 0) {
                            while($row2 = $rsFilter->fetch_assoc()) {?>
                                    <option value="<?=$row2['name']?>" <?if($row2['name']==$row['type']) echo "selected";?>><?=$row2['name']?></option>
                            <?
                            }
                        }
                        ?>
                </select>
            </div>
            <div class="itemViewRow">
                <span><?=$stringQuantity?>&nbsp;:</span>
                <input type="number" class="input" name="quantity" placeholder="<?=$stringQuantity?>" value="<?=$row["quantity"]?>">
            </div>
            <div class="itemViewRow">
                <span><?=$stringPriority?>&nbsp;:</span>
                <input type="number" class="input" name="priority" placeholder="<?=$stringPriority?>" value="<?=$row["priority"]?>">
            </div>
            <div class="itemViewRow">
                <span><?=$stringLength?>&nbsp;:</span>
                <input type="number" class="input" name="length" placeholder="<?=$stringLength?>" value="<?=$row["length"]?>">
            </div>
            <div class="itemViewRow">
                <span><?=$stringHigh?>&nbsp;:</span>
                <input type="number" class="input" name="high" placeholder="<?=$stringHigh?>" value="<?=$row["high"]?>">
            </div>
            <div class="itemViewRow">
                <span><?=$stringWidth?>&nbsp;:</span>
                <input type="number" class="input" name="width" placeholder="<?=$stringWidth?>" value="<?=$row["width"]?>">
            </div>
            <div class="itemViewRow">
                <span><?=$stringDepth?>&nbsp;:</span>
                <input type="number" class="input" name="depth" placeholder="<?=$stringDepth?>" value="<?=$row["depth"]?>">
            </div>
            <div class="itemViewRow">
                <span><?=$stringColor?>&nbsp;:</span>
                <input type="text" class="input" name="color" placeholder="<?=$stringColor?>" value="<?=$row["color"]?>">
            </div>
            <div class="itemViewRow">
                <span><?=$stringMaterial?>&nbsp;:</span>
                <input type="text" class="input" name="material" placeholder="<?=$stringMaterial?>" value="<?=$row["material"]?>">
            </div>
            <div class="itemViewRow">
                <span><?=$stringPosition?>&nbsp;:</span>
                <input type="text" class="input" name="position" placeholder="<?=$stringPosition?>" value="<?=$row["position"]?>">
            </div>
            <div class="itemViewRow">
                <span><?=$stringDescription?>&nbsp;:</span>
                <br>
                <textarea class="inputTextarea" name="description" placeholder="<?=$stringDescription?>"><?=$row["description"]?></textarea>
            </div>
		</form>
	</div>
	<?}?>
	<? if($user["role"]!="user"){?>
    <button class="btnSubmit saveEditItem" type="button">
        <i class="fas fa-save"></i>&nbsp;<?=$stringBtnSubmit?>
    </button>
    <button class="btnSubmit redDel" type="button" onclick="if(confirm('<?=$confirmAlert?>'))location.href='../CORE/sql.php?operation=del&id=<?=$row["id"]?>'">
        <i class="fas fa-trash"></i>&nbsp;<?=$stringBtnDel?>
    </button>
	<?}?>
</div>
<script src="<?=JS_DIR?>/included.js" type="text/javascript"></script>
<?}$conn->close(); ?>
