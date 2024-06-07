<?php include "header.php";

  // $id = $_GET['id'];
  // $db->select('post', 'author', null, "id = '{$id}'", null);
  // $result2 = $db->getResult();
  // foreach($result2 as $row2){
  //   $row2['author'] != $_SESSION["id"];
  // }

 if(isset($_POST['submit'])){
  // print_r($_FILES);
  // die("Hey");
  if(isset($_FILES['fileToUpload']['name']) && $_FILES['fileToUpload']['name'] != ""){
    $errors = array();

    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    
    $file_ext = explode('.', $file_name);
    $file_extension = end($file_ext);

    $extentions = array("jpeg", "jpg", "png"); 

    if(in_array($file_extension, $extentions) === false){
        $errors[] = "This extention file not allowed, please choose JPG or PNG file.";
    }

    if($file_size > 2097152){
        $errors[] = "File size must be 2mb or lower. ";
    }

    if(empty($errors) === true){
        move_uploaded_file($file_tmp, "images/".$file_name);
    }else{
        print_r($errors);
        die();
    }
  }else{
    $file_name = $_POST['old_image'];
  }

  
  
  
  $db = new database();

  $title = $db->escapeString($_POST['post_title']);
  $description = $db->escapeString($_POST['post_desc']);
  $category = $db->escapeString($_POST['category']);

  $db->select('post','*', null, "title = '{$title}'", null, null );
  $post_id = $_GET['id'];
  $db->update('post', array('title'=>$title,'description'=>$description,'category'=>$category, 'post_img' =>$file_name), "id = $post_id");
  
  if($_POST['old_category'] != $_POST['category']){
    $sql = "UPDATE category SET post = post - 1 WHERE id = {$_POST['old_category']}; ";
    $db->sql($sql);
    $sql1 = "UPDATE category SET post = post + 1 WHERE id = {$_POST['category']};";
    $db->sql($sql1);
  }
  
  $result = $db->getResult();
    
  
  
  if (!empty($result)){
    header("Location: {$base_url}admin/posts.php");
  }else{
    echo "<div class = 'alert alert-danger'>Please fill all the fields</div>";
  }

}
?>

<div class="container mt-5">
  <div class="row">
    <div class="col">
      <h2 class="mb-4">Update Post</h2>
      <?php 
        $db = new database();
        $cat_id = $_GET['id'];
        $db->select('post','*', null, "id = '{$cat_id}'", null, null );
        $result = $db->getResult();
        if ($result > 0) {
            foreach($result as $row){
      
      ?>
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] . "?id=" . $cat_id; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" name="id"  class="form-control" value="<?php echo $row['id'];  ?>" placeholder="h">
        </div>
        <div class="form-group">
          <h4 class="mb-3">Title:</h4>
          <input type="text" name="post_title" class="form-control" id="title" value="<?php echo $row['title']; ?>" placeholder="Enter post title">
        </div>
        <div class="form-group">
          <h4 class="mb-3 mt-4">Description:</h4>
          <textarea class="form-control" name="post_desc" id="description" rows="3"><?php echo $row['description']; ?></textarea>
        </div>
        <div class="form-group">
          <h4 class="mb-3 mt-4">Category:</h4>
          <select class="form-control" name="category" id="form-category">
            <option value="">Select category</option>
            <?php 
              $db = new database();
              $db->select('category', '*', null, null, null, null);
              $result1 = $db->getResult();
              // print_r($result1);
              if ($result1 > 0) {
                  // echo "<option value = '{$row['id']}'>{$row['category_name']}</option>";
                  //while($row = mysqli_fetch_assoc($result1)){
                    foreach($result1 as $row1){
                    if($row['category'] == $row1['id']){
                        $selected = "selected";
                    }else{
                        $selected = "";
                    }
                    echo "<option {$selected} value = '{$row1['id']}'>{$row1['category_name']}</option>";
               }
                
                
                // }
              //   while($row1 = mysqli_fetch_assoc($result1)){
              //     if($row['category'] == $row1['id']){
              //         $selected = "selected";
              //     }else{
              //         $selected = "";
              //     }
              //     echo "<option {$selected} value = '{$row1['id']}'>{$row1['category_name']}</option>";
              // }
              }
              
            ?>
          </select>
          <input type="hidden" name="old_category" value="<?php echo $row['category']; ?>">
        </div>
        <div class="form-group">
          <h4 class="mb-3 mt-4">Post Image:</h4>
          <img  src="images/<?php echo $row['post_img']; ?>" height="150px">
          <input type="hidden" name="old_image" value="<?php echo $row['post_img']; ?>">
          <input type="file" class="form-control-file mb-5" name="fileToUpload" id="postImage">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
      </form>
      <?php }
      } ?>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>