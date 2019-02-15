<? include ("../header.php");?>
<?
$query = "SELECT * FROM admin WHERE username LIKE '".$_SESSION['login_user']."'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
?>
<section class="main">
    <div class="rowOptGroup">
        <div class="rowOpt linkItem" data-link="user.php">
            <i class="fas fa-user-circle"></i>
            <div>
                <label class="nameItem"><?=$stringOptUser?></label>
                <br>
                <summary>
                    <?
                    echo ucfirst($row["cognome"])." ".ucfirst($row["nome"]);
                    ?>
                </summary>
            </div>
        </div>
    </div>
    <div class="rowOptGroup">
        <div class="rowOpt">
            <i class="fas fa-language"></i>
            <div>
                <label class="nameItem"><?=$stringOptLang?></label>
                <br>
                <form name="lang_form" id="lang_form" method="post">
                    <select class="inputSelect" name="lang" id="lang" onchange="document.lang_form.submit();">
                        <option value="ita" <?if($lang=="ita") echo "selected";?>>Italiano</option>
                        <option value="eng" <?if($lang=="eng") echo "selected";?>>English</option>
                        <option value="es" <?if($lang=="es") echo "selected";?>>Espagnol</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="rowOpt">
            <i class="fas fa-quidditch"></i>
            <div>
                <label class="nameItem"><?=$stringOptColorUI?></label>
                <br>
                <form name="color_form" id="color_form" method="post">
                    <select class="inputSelect" name="color_pref" id="color_pref" onchange="document.color_form.submit();">
                        <option value="pink" <?if($color=="pink") echo "selected";?>>Pink</option>
                        <option value="green" <?if($color=="green") echo "selected";?>>Green</option>
                        <option value="bw" <?if($color=="bw") echo "selected";?>>Black & White</option>
                        <option value="blue" <?if($color=="blue") echo "selected";?>>Blue</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="rowOptGroup">
        <div class="rowOpt linkItem" data-link="../?available=false">
            <i class="fas fa-folder-open"></i>
            <div>
                <label class="nameItem">NO available</label>
            </div>
        </div>
    </div>
    <?
    if($row["role"]=="super"){
    $query2 = "SELECT id FROM admin";
    $result2 = $conn->query($query2);
    ?>
    <div class="rowOptGroup">
        <div class="rowOpt">
            <i class="fas fa-pencil-ruler"></i>
            <div>
                <label class="nameItem"><?=$stringOptNumUser?></label>
                <summary><?=$result2->num_rows?></summary>
            </div>
        </div>
    </div>
    <?}
    if($row["role"]!="user"){
    ?>
    <div class="rowOptGroup">
        <div class="rowOpt linkItem" data-link="settings_users.php">
            <i class="fas fa-pencil-ruler"></i>
            <div>
                <label class="nameItem"><?=$stringOptRole?></label>
                <summary><?=$stringSummeryChangeRole?></summary>
            </div>
        </div>
    </div>
    <?}?>
    <div class="rowOptGroup">
        <div class="rowOpt">
            <i class="fas fa-copyright"></i>
            <div>
				<p><label class="nameItem linkItem" data-link="../LICENSE">Apache License</label></p>
				<p><label class="nameItem linkItem" data-link="https://github.com/BottyIvan/Archivio">Project on 2019 GitHub, Inc.</label></p>
                <summary>ivanbotty.cloud &copy; <?=date('Y')?></summary>
            </div>
        </div>
    </div>
</section>
<? include ("../footer.php");?>