<form>
    <input type="text" name="id">
    <input type="submit" name="Submit">
</form>
<?php
function sqlConnect()
{
    $servername = "database";
    $username = "root";
    $password = "example";
    $database = "injection";

    return mysqli_connect($servername, $username, $password, $database);
}

if (isset($_GET['Submit'])) {
    $id = $_GET['id'];
    $html = "";
    $id = stripslashes($id);
    $conn=sqlConnect();

    $id = mysqli_real_escape_string($conn,$id);
    if (is_numeric($id)) {
        $getid = "SELECT first_name, last_name FROM users WHERE user_id= '$id'";
        $result = mysqli_query($conn,$getid);

        while ($row=mysqli_fetch_assoc($result)){
            $first = $row["first_name"];
            $last = $row["last_name"];
            $html .= '<pre>';
            $html .= 'ID: ' . $id;
            $html .= '<br>First name:' . $first;
            $html .= '<br>Last name: ' . $last;
            $html .= '</pre>';
        }
    }
    echo $html;
}
