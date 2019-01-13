<?
include("pref/DIR.php");
include("CORE/conn.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form
    $myusername = mysqli_real_escape_string($conn,$_REQUEST['user']);
    $mypassword = mysqli_real_escape_string($conn,md5($_REQUEST['psw'])); 
    $sql = "SELECT * FROM admin WHERE username = '$myusername' and passcode = '$mypassword'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];
    
    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count == 1) {
        $_SESSION['login_user'] = $myusername;
        header("location: ".INDEX."/?init=1");
    }else {
        $error = "Your Login Name or Password is invalid";
    }
}

?>

<form id="ui_log" action="" method="post">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>
                                    <i class="far fa-user-circle"></i>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <label>user</label>
                                </td>
                                <td>
                                    <input type="text" name="user">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>password</label>
                                </td>
                                <td>
                                    <input type="password" name="psw">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <input class="btn btn-light right" type="submit" value="accedi">
                </form>