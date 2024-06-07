<?php include "header.php";
if(isset($_POST['submit'])){
    $db = new database();
    $cat_id = $_GET['id'];

    $cat_name = $db->escapeString($_POST['cat_name']);
    $db->update("category", array('category_name'=>$cat_name), 'id ='.$cat_id);
    $result = $db->getResult();
    
    if(!empty($result)){
        header("Location: {$base_url}admin/category.php");
      }else{
        echo "Query Failed.";
      }
    }
   
?>

<div class="container mt-5">
  <div class="row">
    <div class="col">
      <h2 class="mb-4">Update Category</h2>
      <?php 
        $db = new database();
        $cat_id = $_GET['id'];
        $db->select("category", "*", null, "id ='{$cat_id}'", null, null);
        $result = $db->getResult();
        if ($result > 0) {
        foreach($result as $row){

      ?>
      <form method="POST">
       <div class="form-group">
            <input type="hidden" name="id"  class="form-control" value="<?php echo $row['id'];  ?>" placeholder="h">
        </div>
        <div class="form-group">
          <h4 class="mb-3">Category Name:</h4>
          <input type="text" value="<?php echo $row['category_name']; ?>" class="form-control mb-5" id="title" name="cat_name" placeholder="Category Name">
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
    <?php }
    }else{
        echo "!!! Result Not Found !!!";
    }?>
  </div>
</div>

<?php include "footer.php"; ?>