<?php

include('db.php');

if($_POST){
    $name=$_POST['mp_name'];
    $color=$_POST['mp_color'];
    $sql=" INSERT INTO mp (mp_name,mp_color) VALUES ('$name','$color')";
    $query = $connect->query($sql);
    if($query === TRUE){
        echo "sucess";
    }else{
        echo "error";
    }

    //close db
    $connect->close();
}

?>