<?php include "header.php" ?>

<div id="category">
    <div class="container">
        <div class="row cat-head">
            <div class="col-md-8">
                <?php 
                    $post_id = $_GET['pid'];
                    $db->select('post', 'post.id,post.title,post.description,post.category,post.post_img, post.post_date,users.username,category.category_name' , 'category ON post.category = category.id LEFT JOIN users ON post.author = users.id', "post.id = '{$post_id}'", null);
                    $result = $db->getResult();
                    foreach($result as $row){
                ?>
                <h2 class="mt-5"><?php echo $row['title'] ?></h2>
                <ul class="mb-5">
                    <li><a href="category.php?cid=<?php echo $row['category']; ?>" class="box-anc"><?php echo $row['category_name']; ?></a></li>
                    <li><span class="ml-5"><?php echo date('d M, Y',strtotime($row['post_date'])); ?></span></li>
                </ul>
            </div>
        </div>

        <div class="row menu-content">
            <div class="col-md-8 single-content">
                <img src="images/<?php echo $row['post_img']; ?>" class="mb-5" style="width: 90%;" alt="">
                <p><?php echo $row['description']; ?></p>
            </div>
            <?php } ?>

            <?php include "sidebar.php" ?>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>