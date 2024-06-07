<?php include "header.php"; ?>

<div id="category">
    <div class="container">
        <div class="row cat-head">
            <div class="col-md-12">
                <?php
                   // $db = new database();

                    if(isset($_GET['search'])){
                        $search_term = $_GET['search'];
                    }
                    
                ?>
                 <h2>Search : <?php echo $search_term; ?></h2> 
            </div>
        </div>
        <div class="row menu-content content">
            <div class="col-md-8" style="border-right:1px solid var(--grey) ;">
            <?php
                $db->select('post', 'post.id,post.title,post.description,post.category,post.post_img, post.author, post.post_date,users.username,category.category_name' , 'category ON post.category = category.id LEFT JOIN users ON post.author = users.id',  "post.title LIKE '%{$search_term}%' OR post.description LIKE '%{$search_term}%'", null);
                $result =$db->getResult();
                if(count($result) > 0){
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
                </div>
            </div>
            <?php } }else{
                echo "<h2> No result Found </h2> ";
            } ?>
            </div>
        <?php include "sidebar.php"; ?>

            
        </div>
    </div>
</div>
</div>

<?php include "footer.php"; ?>