<?php include "header.php";

if(isset($_POST['save'])){
  $db = new database();

  $full_name =  $db->escapeString($_POST['full_name']);
  $username =  $db->escapeString($_POST['username']);
  $password =  md5($db->escapeString($_POST['password']));

  $db->select('users', '*', null, "username = '{$username}'", null, null);
  $result = $db->getResult();

  if(!empty($result)){
    echo 'Username Already exists.';
  }else{
    $db->insert('users', array('full_name'=>$full_name, 'username'=>$username ,'password'=>$password));
    $result = $db->getResult();

    if(!empty($result)){
      header("Location: {$base_url}admin/users.php");
    }
  }

}

?>

<div class="container mt-5">
  <div class="row">
    <div class="col">
      <h2 class="mb-4">Add User</h2>
      <form method="POST">
        <div class="form-group">
          <h4 class="mb-3">Full Name:</h4>
          <input type="text" name="full_name" class="form-control mb-4" id="title" placeholder="Full Name">
        </div>

        <div class="form-group">
          <h4 class="mb-3">Username:</h4>
          <input type="text" name="username" class="form-control mb-4" id="title" placeholder="Username">
        </div>

        <div class="form-group">
          <h4 class="mb-3">Password:</h4>
          <input type="password" name="password" class="form-control mb-4" id="title" placeholder="Password">
        </div>
        
        <button type="submit" name="save" class="btn btn-primary">Save</button>
      </form>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>