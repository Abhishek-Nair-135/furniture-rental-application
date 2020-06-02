<?php
    session_start();
    $id = $_POST['val'];
    if(!in_array($id,$_SESSION['visited']))
        array_push($_SESSION['visited'],$id);
    print_r($_SESSION['visited']);
 
?>