<?php include "header.php"?>
<div id="sidebar">
    <div class="container">
    <?php
            $limit = 8;
            $db->select('post', 'post.id,post.title,post.description,post.category,post.post_img, post.post_date,users.username,category.category_name' , 'category ON post.category = category.id LEFT JOIN users ON post.author = users.id', null, null, $limit);
            $result =$db->getResult();
            
        ?>
        <div class="row menu-content">
            <div class="col-md-8" style="border-right:1px solid var(--grey) ;">
                <?php foreach($result as $row){ ?>
                <!-- Box 1 -->
                <div class="row box">
                    <div class="col-md-5">
                    <a href="single.php?pid=<?php echo $row['id']; ?>"><img src="images/<?php echo $row['post_img']; ?>" class="card-img" alt="Image 1"></a>
                    </div>
                    <div class="col-md-7">
                        <a href="single.php?pid=<?php echo $row['id']; ?>" class="box-heading ps-3"><?php echo $row['title']; ?></a>
                        <a href="category.php?cid=<?php echo $row['category']; ?>" class="box-anc"><?php echo $row['category_name']; ?></a><span><?php echo date('d M, Y',strtotime($row['post_date'])); ?></span>
                        <p class="ps-3"><?php echo substr($row['description'],0,130). "..."; ?></p>
                    </div>
                </div>
                <?php }

                echo $db->pagination('post', 'category ON post.category = category.id LEFT JOIN users ON post.author = users.id', null, $limit);

                ?>
            </div>
        <?php include "sidebar.php"; ?>
    </div>
</div>
</div>

<?php include "footer.php"; ?>