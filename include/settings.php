<? include ("../header.php");?>
<section class="main">
    <div class="rowOptGroup">
        <div class="rowOpt">
            <i class="fas fa-user-circle"></i>
            <div>
                <label class="nameItem"><?=$stringOptUser?></label>
                <br>
                <summary>
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
</section>
<? include ("../footer.php");?>