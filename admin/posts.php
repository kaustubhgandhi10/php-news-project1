<?php include "header.php"; ?>

<div id="category" class="min-height">
    <div class="container">
        <div class="row">
            <div class="col-md-10 categ">
                <h2>All Posts</h2>
            </div>
            <div class="col-md-2">
                <a href="add-post.php" class="btn btn-outline-success  bd-highlight" type="submit">ADD POSTS</a>
            </div>
            <div class="col-md-12">
                <?php 
                    $limit = 5;
                    $uid = $_SESSION['uid'];
                    $db = new database();
                    if($uid != '1'){
                        $db->select('post', 'post.id,post.title,post.description,post.category,  post.post_date,users.username,category.category_name' , 'category ON post.category = category.id LEFT JOIN users ON post.author = users.id', "author={$uid}", null, $limit);
                    }else{
                        $db->select('post', 'post.id,post.title,post.description,post.category,  post.post_date,users.username,category.category_name' , 'category ON post.category = category.id LEFT JOIN users ON post.author = users.id', null, null, $limit);
                    }
                    $result = $db->getResult();
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = 1;
                    }
                    $offset = ($page - 1) * $limit;
                    $serial = $offset + 1;
                    if(count($result) > 0){
                ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>S no.</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Author</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    <tbody>
                    <?php foreach($result as $row){  ?>
                        <tr>
                        <td><?php echo $serial; ?></td>
                        <td><?php  echo $row['title']; ?></td>
                        <td><?php echo $row['category_name']; ?></td>
                        <td><?php echo date('d M, Y',strtotime($row['post_date'])); ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td>
                    <a class="btn btn-primary" href="update-post.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a class="btn btn-danger" href="delete-post.php?id=<?php echo $row['id']; ?>&cid=<?php echo $row['category']; ?>">Delete</a>
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
                if($uid != '1'){
                    echo $db->pagination('post', null, "author={$uid}", $limit);
                }else{
                    echo $db->pagination('post', null, null, $limit);
                }

                ?>       
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>