<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "dummy_db";

$dbh = mysqli_connect($server, $username, $password, $dbname);
if (!$dbh) {
    echo "Connection failed";
}

$imgquery = "SELECT * FROM images";
$imgres = mysqli_query($dbh,$imgquery);
if (!$imgres){
    echo "Image fetch Failed";
}

$imgfetch = mysqli_fetch_all($imgres,MYSQLI_ASSOC);


if (isset($_POST['submit1'])) {
    $name = $_POST['name'];
    $add = $_POST['add'];
    $Mob_No = floatval($_POST['mob']);

    $query = "INSERT INTO userinfo (Name, Address, Mob_No) VALUES ('" . $name . "','" . $add . "','" . $Mob_No . "')";
    $res = mysqli_query($dbh, $query);
    if (!$res) {
        echo "Adding Failed" . mysqli_error($dbh);
    }else {
        echo "Success";
    }
}

if (isset($_POST['submit2'])) {
    $name = $_POST['name1'];

    $query = "SELECT * FROM userinfo WHERE Name = '" .$name. "'";
    $res = mysqli_query($dbh, $query);
    
    if (!$res) {
        echo "Retrieval Failed" . mysqli_error($dbh);
    }
    echo "<table border = '1 px'><thead><tr><td>Name</td><td>Address</td><td>Mob No</td></tr></thead>";
    while($row = mysqli_fetch_assoc($res))
    {
        echo "<tr><td>" .$row["Name"]. "</td><td>" .$row["Address"]. "</td><td>" .$row["Mob_No"]. "</td></tr>";
    }
    
}
?>
