<?
//ottengo il file per la connessione
include ('conn.php');
include ('../session.php');

$id = $_REQUEST["id"];

//Limit on data display
$showLimit = 5;

if(!empty($id)){
        
    //Get all rows except already displayed
    $query = "SELECT COUNT(*) as num_rows FROM archive WHERE id < ".$id." ORDER BY id DESC";
    $queryAll = $conn->query($query);
    $rowAll = $queryAll->fetch_assoc();
    $allNumRows = $rowAll['num_rows'];
    
    //Get rows by limit except already displayed
    $query = "SELECT * FROM archive WHERE id < ".$id." ORDER BY id DESC LIMIT ".$showLimit;
    $result = $conn->query($query);
    
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $last_id = $row["id"];
            ?>
            <div class="row openView" data-link="<?="../archivio/include/item.php?id=".$row["id"]?>">
                <div>
                    <span class="nameItem fullText"><?=$row["name"]?></span>
                    <br>
                    <span class="descItem fullText"><?=$row["description"]?></span>
                </div>
                <span class="quantityItem"><span><?=$row["quantity"]?></span></span>
            </div>
        <?}
        if($allNumRows > $showLimit){?>
             <div class="loadingMore" fetch-data="<?=$last_id?>"></div>
        <?} else {?>
            <div class="loadingMore" fetch-data="0"></div>
        <?}
    } else {?>
        <div class="loadingMore" fetch-data="0"></div>
    <?}
}
?>