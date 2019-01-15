<? include ("../header.php");?>
<section class="main">
    <div class="rowOptGroup">
        <div class="rowOpt linkItem" data-link="user.php">
            <i class="fas fa-user-circle"></i>
            <div>
                <label class="nameItem"><?=$stringOptUser?></label>
                <br>
                <summary>
                    <?
                    $query = "SELECT * FROM admin WHERE username LIKE '".$_SESSION['login_user']."'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo ucfirst($row["cognome"])." ".ucfirst($row["nome"]);
                    }
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
                        <option value="pink" <?if($colorPrefUI=="pink") echo "selected";?>>Pink</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="rowOptGroup">
        <div class="rowOpt linkItem" data-link="../LICENSE">
            <i class="fas fa-copyright"></i>
            <div>
                <label class="nameItem">Apache License</label>
                <summary>ivanbotty.cloud &copy; <?=date('Y')?></summary>
            </div>
        </div>
    </div>
</section>
<? include ("../footer.php");?>