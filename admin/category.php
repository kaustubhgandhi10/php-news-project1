<?php include "header.php"; ?>

<div id="category" class="min-height">
    <div class="container">
        <div class="row">
            <div class="col-md-10 categ">
                <h2>All Categories</h2>
            </div>
            <div class="col-md-2">
                <a href="add-category.php" class="btn btn-outline-success  bd-highlight" type="submit">ADD CATEGORY</a>
            </div>
            <div class="col-md-12">
            <?php 
                $limit = 6;
                $db = new database();
                $db->select('category', '*', null,null,null,$limit);
                $result = $db->getResult();
                $serial = 1;
                if(isset($_GET['page']) && $_GET['page'] > 1){ $serial= $serial+$limit;}
                if(count($result) > 0){
            ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>S no.</th>
                            <th>Category Name</th>
                            <th>No. of Posts</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    <tbody>
                        <?php foreach($result as $row){  ?>
                            <tr>
                                <td><?php echo $serial; ?></td>
                                <td><?php echo $row['category_name'] ?></td>
                                <td><?php echo $row['post'] ?></td>
                                <td>
                                    <a class="btn btn-primary" href="update-category.php?id=<?php echo $row["id"]; ?>">Edit</a>
                                    <a class="btn btn-danger"  href="delete-category.php?id=<?php echo $row["id"]; ?>" >Delete</a>
                                </td>
                            </tr>
                        <?php
                         $serial++;
                        } ?>
            
                    </tbody>
                </table> 
                <?php }else{
                    echo "No Result Found";
                }

                echo $db->pagination('category', null, null, $limit);
                
                ?>       
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>