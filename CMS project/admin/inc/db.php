<?php

$db = mysqli_connect("localhost", "root", "", "todo");


if($db){
    // echo "Database connect successfully";
}
else{
    die("Mysqli connection error." . "mysqli_error($db)");
}

?>