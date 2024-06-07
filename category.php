<?php include "header.php"; ?>

<div id="category">
    <div class="container">
        <div class="row cat-head">
            <div class="col-md-12">
                <?php
                   // $db = new database();
                   $limit = 8;

                    if(isset($_GET['cid'])){
                        $cat_id = $_GET['cid'];
                    }

                    $db->select('category', '*', null, "id = '{$cat_id}'", null, $limit);
                    $result = $db->getResult();
                    foreach($result as $row);
                ?>
                <h2><?php echo $row['category_name']; ?></h2>
            </div>
        </div>
        <div class="row menu-content content">
            <div class="col-md-8" style="border-right:1px solid var(--grey) ;">
            <?php
                //$db = new database();
                $db->select('post', 'post.id,post.title,post.description,post.category,post.post_img, post.post_date,users.username,category.category_name' , 'category ON post.category = category.id LEFT JOIN users ON post.author = users.id',  "post.category = '{$cat_id}'", null);
                $result =$db->getResult();
                foreach($result as $row){
            ?>
            <div class="row box">
                <div class="col-md-5">
                <a href="single.php?id=<?php echo $row['id']; ?>"><img src="images/<?php echo $row['post_img']; ?>" class="card-img" alt="Image 1"></a>
                </div>
                <div class="col-md-7">
                    <a href="single.php?pid=<?php echo $row['id']; ?>" class="box-heading ps-3"><?php echo $row['title']; ?></a>
                    <a href="category.php?cid=<?php echo $row['category']; ?>" class="box-anc"><?php echo $row['category_name']; ?></a><span><?php echo $row['post_date']; ?></span>
                    <p class="ps-3"><?php echo substr($row['description'],0,130). "..."; ?></p>
                    <!-- readmore left here -->
                </div>
            </div>
            <?php }
            
            echo $db->pagination('category', null,"id = '{$cat_id}'", $limit);

            ?>
            </div>
        <?php include "sidebar.php"; ?>

            
        </div>
    </div>
</div>
</div>

<?php include "footer.php"; ?>