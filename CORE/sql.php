<?
//ottengo il file per la connessione
include ('conn.php');

$operation = $_REQUEST["operation"];
$id = $_REQUEST["id"];
$items = $_POST;

if($operation=="add"){
    $queryInsert = "INSERT INTO archive(";
    foreach($items as $item => $value){
         $queryInsert .= $item.",";
    }
    $queryInsert = substr($queryInsert,0,-1);
    $queryInsert .= ") VALUES (";
    foreach($items as $item => $value){
         $queryInsert .= "'".$value."',";
    }
    $queryInsert = substr($queryInsert,0,-1);
    $queryInsert .= ")";
    echo $queryInsert;
    
    if ($conn->query($queryInsert) != TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    header("location: ../");
}

if($operation=="edit"){
    $queryEdit= "UPDATE archive";
    $queryEdit .= " SET ";
    foreach($items as $item => $value){
         $queryEdit .= $item."='".$value."',";
    }
    $queryEdit = substr($queryEdit,0,-1);
    $queryEdit .= " WHERE id=$id";
    echo $queryEdit;

    if ($conn->query($queryEdit) != TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header("location: ../");
}

if($operation=="del"){
    $queryDel= "DELETE FROM archive WHERE id=$id";
    
    if ($conn->query($queryDel) != TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header("location: ../");
}

$conn->close();
?>