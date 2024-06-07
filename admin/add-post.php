<?php include "header.php";
 if(isset($_POST['save'])){
  if(isset($_FILES['fileToUpload'])){
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
  }
  
  $db = new database();
  $title = $db->escapeString($_POST['post_title']);
  $description = $db->escapeString($_POST['post_desc']);
  $category = $db->escapeString($_POST['category']);
  $date = date("Y-m-d h:i:s");
  $author = '1';

  $db->select('post','*', null, "title = '{$title}'", null, null );
  $result = $db->getResult();

  
    
  if(!empty($result)){
    echo 'Post title Already exists.';
  }else{
    $db->insert('post', array('title'=>$title,'description'=>$description,'category'=>$category,'post_date'=>$date,'author'=>$author,'post_img' =>$file_name));
    $db->sql("UPDATE category SET post = post + 1 WHERE id = {$category}");
    $result = $db->getResult();

    if(!empty($result)){
      header("Location: {$base_url}admin/posts.php");
    }
  }

  // if (!empty($result)){
  //   header("Location: {$base_url}admin/posts.php");
  // }else{
  //   echo "<div class = 'alert alert-danger'>Please fill all the fields</div>";
  // }

}
?>

<div class="container mt-5">
  <div class="row">
    <div class="col">
      <h2 class="mb-4">Add New Post</h2>
      <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <h4 class="mb-3">Title:</h4>
          <input type="text" name="post_title" class="form-control" id="title" placeholder="Enter post title">
        </div>
        <div class="form-group">
          <h4 class="mb-3 mt-4">Description:</h4>
          <textarea class="form-control" name="post_desc" id="description" rows="3"></textarea>
        </div>
        <div class="form-group">
          <h4 class="mb-3 mt-4">Category:</h4>
          <select class="form-control" name="category" id="form-category">
            <option value="">Select category</option>
            <?php 
              $db = new database();
              $db->select('category', '*', null, null, null, null);
              $result = $db->getResult();

              foreach($result as $row){
                echo "<option value = '{$row['id']}'>{$row['category_name']}</option>";
              }
              
            ?>
          </select>
        </div>
        <div class="form-group">
          <h4 class="mb-3 mt-4">Post Image:</h4>
          <input type="file" class="form-control-file mb-5" name="fileToUpload" id="postImage">
        </div>
        <button type="submit" name="save" class="btn btn-primary">Save</button>
      </form>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>