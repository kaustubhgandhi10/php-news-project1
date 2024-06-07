<?php include "header.php";

if(isset($_POST['submit'])){
  $db = new database();

  $user_id = $_GET['id'];
  $full_name =  $db->escapeString($_POST['full_name']);
  $username =  $db->escapeString($_POST['username']);

  $db->update("users", array('full_name'=>$full_name, 'username'=>$username), 'id ='.$user_id);
  
  $result = $db->getResult();

  if(!empty($result)){
    header("Location: {$base_url}admin/users.php");
  }else{
    echo "Query Failed.";
  }
}

?>

<div class="container mt-5">
  <div class="row">
    <div class="col">
      <h2 class="mb-4">Update User</h2>
      <?php 
        $db = new database();
        $user_id = $_GET['id'];
        $db->select('users', '*', null, "id = '{$user_id}'", null, null);
        $result = $db->getResult();
        if ($result > 0) {
        foreach($result as $row){
      
      ?>
      <form method="POST">
        <div class="form-group">
            <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['id'];  ?>" placeholder="h">
        </div>
        <div class="form-group">
          <h4 class="mb-3">Full Name:</h4>
          <input type="text" value="<?php echo $row['full_name']; ?>" name="full_name" class="form-control mb-4" id="title" placeholder="Full Name">
        </div>

        <div class="form-group">
          <h4 class="mb-3">Username:</h4>
          <input type="text" value="<?php echo $row['username']; ?>" name="username" class="form-control mb-4" id="title" placeholder="Username">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Update</button>
      </form>
      <?php }
      } ?>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>