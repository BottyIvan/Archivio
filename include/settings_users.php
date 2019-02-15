<? include ("../header.php");?>
<section class="main">
<?
// get the role of user logged
$queryRole = "SELECT * FROM admin WHERE username LIKE '".$_SESSION['login_user']."'";
$resultRole = $conn->query($queryRole);
$rowRole = $resultRole->fetch_assoc();
$user_role = $rowRole['role'];
// get all user
$query = "SELECT * FROM admin";
$result = $conn->query($query);
while($row = $result->fetch_assoc()){
	if(!is_null($row['nome']) AND !is_null($row['cognome'])) $name = $row['nome']." ".$row['cognome'];
	else $name = "I'm no one.";
	if(!is_null($row['username'])) $user = "@".$row['username'];
	else $user = "--";
	if(!is_null($row['role'])) $role = $row['role'];
	else $role = "NO ROLE";
?>
    <div class="rowOptGroup">
        <div class="rowOpt">
			<span class="userIcon"  style="background: url(<?=INDEX."/user/".$row['photo']?>)"></span>
            <div>
                <label class="nameItem"><?=$name?></label>
				<summary><?=$user?> ・ <?=$role?></summary>
            </div>
			<form action="../CORE/sql.php?operation=edit_user&id=<?=$row["id"]?>" method="post" name="form_<?=$row["id"]?>" id="form_<?=$row["id"]?>">
				<select name="role" id="edit_user" onchange="document.form_<?=$row["id"]?>.submit();">
					<option value="user" <?if($row['role'] == 'user') echo 'selected';?>>User</option>
					<?if($user_role != 'user'){?>
					<option value="admin" <?if($row['role'] == 'admin') echo 'selected';?>>Admin</option>
					<?}
					if($user_role == 'super'){?>
					<option value="super" <?if($row['role'] == 'super') echo 'selected';?>>Super</option>
					<?}?>
				</select>
			</form>
        </div>
    </div>
<?}?>
</section>
<? include ("../footer.php");?>