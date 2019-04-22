<?
$query = "SELECT * FROM archive WHERE available='$available' AND (name LIKE '%$search%' OR id LIKE '%$search%') AND type LIKE '%$typeFilter%' AND bucket LIKE '%$bucket%' ORDER BY id DESC";
$result = $conn->query($query);
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