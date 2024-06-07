<?php include "header.php";

    
?>

<div id="cards" class="min-height">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 cards-content">
                    <?php 
                        $db = new database();
                        $db->select('post', '*', null, null, null);
                        $result = $db->getResult();
                    ?>
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">POSTS</h5>
                            <p class="card-text"><?php echo count($result); ?></p>
                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <?php 
                                $db1 = new database();
                                $db1->select('category', '*', null, null, null);
                                $result1 = $db1->getResult();
                            ?>
                            <h5 class="card-title">CATEGORIES</h5>
                            <p class="card-text"><?php echo count($result1); ?></p>
                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <?php 
                                $db2 = new database();
                                $db2->select('users', '*', null, null, null);
                                $result2 = $db2->getResult();
                            ?>
                            <h5 class="card-title">USERS</h5>
                            <p class="card-text"><?php echo count($result2); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>
    