<?php 

    include "config.php";

    $db = new database();
    $cat_id = $_GET['id'];
    $db->delete('category', 'id ='.$cat_id);
    $result = $db->getResult();

    if(!empty($result)){
        header("Location: {$base_url}admin/category.php");
      }else{
        echo "Query Failed.";
      }

?>