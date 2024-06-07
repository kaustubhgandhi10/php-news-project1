<?php include "header.php";

if(isset($_POST['save'])){
  if(empty($_FILES['logo']['name'])){
      $file_name = $_POST['old-logo'];
  }else{
      $errors = array();

      $file_name = $_FILES['logo']['name'];
      $file_size = $_FILES['logo']['size'];
      $file_tmp = $_FILES['logo']['tmp_name'];
      $file_type = $_FILES['logo']['type'];
      $exp = explode('.',$file_name);
      $file_ext  = end($exp);
      $extentions = array("jpeg", "jpg", "png"); 

      if(in_array($file_ext, $extentions) === false){
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
  $website_name = $db->escapeString($_POST['website_name']);
  $id = $db->escapeString($_POST['id']);
  $footer_desc = $db->escapeString($_POST['footer_desc']);
  $db->update('settings', array('website_name' =>$website_name, 'logo' =>$file_name, 'footer_desc' =>$footer_desc), 'id ='.$id);
  $result = $db->getResult();
  if(!empty($result)){
      header("Location: {$base_url}admin/dashboard.php");
    }else{
      echo 'Query Failed.';
    }
  }

?>

<div id="settings" class="min-height">
<div class="container ">
  <div class="row">
    <div class="col">
      <h2 class="mb-5">Website Settings</h2>
    </div>
    <div class="col-md-12">
      <?php
        $db = new database();
        $db->select('settings', '*', null, null);
        $result = $db->getResult();
        if(count($result) > 0){
          foreach($result as $row){
      ?>
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" name="id"  class="form-control" value="<?php echo $row['id'];  ?>" placeholder="h">
        </div>
      
        <div class="form-group">
          <label for="website_name"><h4>Website Name: </h4></label>
          <input type="text" name="website_name" value="<?php echo $row['website_name']; ?>" placeholder="Enter website name" class="form-control mb-5" autocomplete="off" required>
        </div>

        <div class="form-group">
          <label for="logo"><h4>Website Logo:</h4></label>
          <input type="file" class="mb-5 form-control" name="logo" accept="image/png, image/jpeg">
          <img class="mb-5" src="images/<?php echo $row['logo']; ?>">
          <input type="hidden" name="old_logo" value="<?php echo $row['logo']; ?>" >
        </div>

        <div class="form-group">
          <label for="footer_desc"><h4>Footer Description:</h4></label>
          <textarea class="form-control mb-5" name="footer_desc"  rows="3"><?php echo $row['footer_desc']; ?></textarea>
        </div>

        <button type="submit" name="save" class="btn btn-primary">Save</button>

      </form>
      <?php } } ?>
    </div>
  </div>
</div>
</div>

<?php include "footer.php"; ?>
