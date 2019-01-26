<? include ("../header.php");
$query = "SELECT * FROM admin WHERE username LIKE '".$_SESSION['login_user']."'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();?>
    <section class="main">
        <div class="rowOptGroup">
            <div class="rowOpt">
                <div>
                    <div>
                        <div class="userIconFull" style="background: url(<?=INDEX."/user/".$row['photo']?>)"></div>
                    </div>
                    <div>
                        <h3><?=$row["username"]?></h3>
                    </div>
                    <br>
                    <form action="../CORE/sql.php?operation=add_photo" method="post" enctype="multipart/form-data">
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" value="Upload Image" name="submit">
                    </form>
                </div>
            </div>
        </div>
        <div class="rowOptGroup">
            <div class="rowOpt">
                <i class="fas fa-user-circle"></i>
                <div>
                    <?=$stringName.": ".ucfirst($row["cognome"])." ".ucfirst($row["nome"]);?>
                </div>
            </div>
            <div class="rowOpt">
                <i class="fas fa-key"></i>
                <div>
                    <?=$stringOptPsw;?>
                </div>
            </div>
            <div class="rowOpt">
                <i class="fas fa-pencil-ruler"></i>
                <div>
                    <span><?=$stringOptRole?>&nbsp;:&nbsp;</span><?=$row["role"]?>
                </div>
            </div>
        </div>
    </section>
<? }
include ("../footer.php");?>