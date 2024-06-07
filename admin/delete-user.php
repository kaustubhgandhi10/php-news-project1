<?php 

    include "config.php";

    $db = new database();
    $user_id = $_GET['id'];
    $db->delete('users', 'id ='.$user_id);
    $result = $db->getResult();

    if(!empty($result)){
        header("Location: {$base_url}admin/users.php");
      }else{
        echo "Query Failed.";
      }

?>