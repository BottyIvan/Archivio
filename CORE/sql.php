<?
//ottengo il file per la connessione
include ('conn.php');
include ('../session.php');

$operation = $_REQUEST["operation"];
$id = $_REQUEST["id"];
$items = $_POST;

// upload item photo
$tmpItemPhoto = $_FILES["itemPhoto"]["tmp_name"];
$itemPhoto = $_FILES["itemPhoto"]["name"];
$dirItem = "../itemPhoto/".$id;

// upload user profile photo
$tmpPhoto = $_FILES["fileToUpload"]["tmp_name"];
$photo = $_FILES["fileToUpload"]["name"];
$dir = "../user/".$_SESSION['login_user'];

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
        echo "Error: " . $queryInsert . "<br>" . $conn->error;
    } else $last_id = $conn->insert_id;
    
    if(!is_null($tmpItemPhoto)){
        $dirItem = "../itemPhoto/".$last_id;
        $dirItem = checkForDir($dirItem);    
        uploadItemPhoto($dirItem,$itemPhoto,$tmpItemPhoto,$last_id,$conn);
    }
        
    header("location: ../");
}

if($operation=="edit"){
    $queryEdit= "UPDATE archive";
    $queryEdit .= " SET ";
	if(isset($items['data']) AND !is_null($items['data'])){
		foreach($items['data'] as $item => $val){
			$queryEdit .= $val['name']."='".$val['value']."',";
			if($val['name']=="quantity" AND $val['value']==0) $queryEdit .= "available='false',";
			elseif($val['name']=="quantity" AND $val['value']>0) $queryEdit .= "available='true',";
		}
	} else {
		foreach($items as $item => $value){
			$queryEdit .= $item."='".$value."',";
			if($item=="quantity" AND $value==0) $queryEdit .= "available='false',";
			elseif($item=="quantity" AND $value>0) $queryEdit .= "available='true',";
		}
	}
    $queryEdit = substr($queryEdit,0,-1);
    $queryEdit .= " WHERE id=$id";
	
    if ($conn->query($queryEdit) != TRUE) {
        echo "Error: " . $queryEdit . "<br>" . $conn->error;
    }
	
    header("location: ../");
}


if($operation=="edit_photo"){
     if(!is_null($tmpItemPhoto)){
        $dirItem = "../itemPhoto/".$id;
        $dirItem = checkForDir($dirItem);   
        $is_uploaded = uploadItemPhoto($dirItem,$itemPhoto,$tmpItemPhoto,$id,$conn);
    }
   
	$query = "SELECT * FROM archive_item_image WHERE id_archive = $id ORDER BY id DESC";
	$rs = $conn->query($query);
	$img = $rs->fetch_assoc();
	echo $img['image'];
	exit();
}

if($operation=="del_photo"){
	$query = "SELECT * FROM archive_item_image WHERE id = $id";
	$rs = $conn->query($query);
	$img = $rs->fetch_assoc();

	if(unlink($img['image'])){
		$queryDelPhoto = "DELETE FROM archive_item_image WHERE id = $id";
		 if ($conn->query($queryDelPhoto) != TRUE) {
			echo "Error: " . $queryEdit . "<br>" . $conn->error;
		}	
	}
	
	exit();
}

if($operation=="del"){
    $queryDel= "UPDATE archive SET available='false' WHERE id=$id";
    
    if ($conn->query($queryDel) != TRUE) {
        echo "Error: " . $queryDel . "<br>" . $conn->error;
    }
    header("location: ../");
}

if($operation=="edit_user"){
	$queryEdit= "UPDATE admin";
    $queryEdit .= " SET ";
    foreach($items as $item => $value){
        $queryEdit .= $item."='".$value."',";
    }
    $queryEdit = substr($queryEdit,0,-1);
    $queryEdit .= " WHERE id=$id";

    if ($conn->query($queryEdit) != TRUE) {
        echo "Error: " . $queryEdit . "<br>" . $conn->error;
    }
    
     if(!is_null($tmpItemPhoto)){
        $dirItem = "../itemPhoto/".$id;
        $dirItem = checkForDir($dirItem);    
        uploadItemPhoto($dirItem,$itemPhoto,$tmpItemPhoto,$id,$conn);
    }
    
    header("location: ../");
}

if($operation=="add_photo"){
    if(!is_dir($dir)){
        if (!mkdir($dir, 0777, true)) die('Failed to create folders...');
        else uploadUserPhoto($dir,$photo,$tmpPhoto,$conn);
    }
    else{
        uploadUserPhoto($dir,$photo,$tmpPhoto,$conn);
    }
    header("location: ../");
}

function checkForDir($dir){
    if(!is_dir($dir)){
        if (!mkdir($dir, 0777, true)) die('Failed to create folders...');
        else return $dir;
    }
    else{
        return $dir;
    }
}

function uploadItemPhoto($dir,$photo,$tmpPhoto,$id_archive,$conn){
    $target_file = $dir."/".basename($photo);
    $uploadOk = 1;
    // Check if image file is a actual image or fake image
    $check = getimagesize($tmpPhoto);
    if($check !== false) {
        if (move_uploaded_file($tmpPhoto, $target_file)) {
            $queryAddPhoto= "INSERT INTO archive_item_image(id_archive,image) VALUES ($id_archive,'$target_file')";
            if ($conn->query($queryAddPhoto) != TRUE) {
                echo "Error: " . $queryAddPhoto . "<br>" . $conn->error;
            }
        }
        $uploadOk = 1;
		// upload file ok
    } else {
        $uploadOk = 0;
		// upload file error
    }
	return $uploadOk;
}

function uploadUserPhoto($dir,$photo,$tmpPhoto,$conn){
    $target_file = $dir."/".basename($photo);
    $uploadOk = 1;
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($tmpPhoto);
        if($check !== false) {
            if (move_uploaded_file($tmpPhoto, $target_file)) {
                $queryAddPhoto= "UPDATE admin SET photo='$target_file' WHERE username LIKE '".$_SESSION['login_user']."'";
                if ($conn->query($queryAddPhoto) != TRUE) {
                    echo "Error: " . $queryAddPhoto . "<br>" . $conn->error;
                }
            }
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
}

$conn->close();
?>