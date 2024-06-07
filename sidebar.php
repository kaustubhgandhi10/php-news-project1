<div class="col-md-4 sidebox">
  <h2 class="mb-4">Latest Articles</h2>
        <?php 
           // $db->select('post', 'post.id,post.title,post.post_img, post.post_date', null, null,RAND(), 5);
           $sql = "SELECT * FROM post ORDER BY RAND() LIMIT 5";
            $db->sql($sql);
            $result = $db->getResult();

            // echo "<pre>";
            // print_r($result[0]);
            // echo "</pre>";
            // die();

            foreach($result[0] as $row){
        ?>
    <div class="row side-box">
        <div class="col-md-8 recent-post">
            <a href="single.php?pid=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
            <span><?php echo date('d M, Y',strtotime($row['post_date'])); ?></span>
        </div>
        <div class="col-md-4">
            <a href="single.php?pid=<?php echo $row['id']; ?>"><img src="images/<?php echo $row['post_img']; ?>" style="width: 110%;" class="card-img-top" alt="Recent News Image 1"></a>
        </div>
    </div>
    <?php } ?>
  </div>