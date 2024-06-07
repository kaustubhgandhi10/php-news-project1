<?php 

include "config.php";

$db = new database();
$post_id = $_GET['id'];
$cat_id = $_GET['cid'];
$db->delete('post', 'id ='.$post_id);
$db->select('post', 'id ='.$post_id);
$sql = "UPDATE category SET post = post - 1 WHERE id = {$cat_id}";
$db->sql($sql);
$result = $db->getResult();

if(!empty($result)){
   
  header("Location: {$base_url}admin/posts.php");
  }else{
    echo "Query Failed.";
  }


?>