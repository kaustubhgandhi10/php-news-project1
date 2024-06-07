<?php include "header.php";

  if(isset($_POST['save'])){
    // include "config.php";
    $db = new database();
    $category = $db->escapeString($_POST['cat']);

    $db->select('category', 'category_name', null, "category_name = '{$category}'", null, null);
    $result = $db->getResult();

    if(!empty($result)){
      echo 'Category Already exists.';
    }else{
      $db->insert('category', array('category_name'=>$category,'post'=>0));
      $result = $db->getResult();

      if(!empty($result)){
        header("Location: {$base_url}admin/category.php");
      }
    }
  }

?>

<div class="container mt-5">
  <div class="row">
    <div class="col">
      <h2 class="mb-4">Add New Category</h2>
      <form method="POST">
        <div class="form-group">
          <h4 class="mb-3">Category Name:</h4>
          <input type="text" class="form-control mb-5" id="title" name="cat" placeholder="Category Name">
        </div>
        
        <button type="submit" name="save" class="btn btn-primary">Save</button>
      </form>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>