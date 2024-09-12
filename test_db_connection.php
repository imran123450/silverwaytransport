<?php

require_once 'config/database.php';
$database = new database(); 

$conn = $database->getConnection();
if($conn)
{
    echo "success";
}
else{
    echo "not success";
}
?>