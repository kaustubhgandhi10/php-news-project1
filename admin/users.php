<?php include "header.php"; ?>

<div id="category" class="min-height">
    <div class="container">
        <div class="row">
            <div class="col-md-10 categ">
                <h2>All Users</h2>
            </div>
            <div class="col-md-2">
                <a href="add-users.php" class="btn btn-outline-success  bd-highlight" type="submit">ADD USER</a>
            </div>
            <div class="col-md-12">
                <?php 
                $limit = 3;
                    $db = new database();
                    $db->select('users', '*', null, null, null, $limit);
                    $result = $db->getResult();
                    $serial = 1;
                    if(isset($_GET['page']) && $_GET['page'] > 1){ $serial= $serial+$limit;}
                    if(count($result) > 0){
                ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>S no.</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    <tbody>
                    <?php foreach($result as $row){  ?>
                        <tr>
                        <td><?php echo $serial; ?></td>
                        <td><?php echo $row['full_name'] ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td>
                    <a class="btn btn-primary" href='update-user.php?id=<?php echo $row["id"];?>'>Edit</a>
                        <?php if($row['id'] != '1'){ ?>
                        <a class="btn btn-danger" href='delete-user.php?id=<?php echo $row["id"];?>'>Delete</a>
                    <?php } ?>
                </td>
                        </tr>
                    <?php
                        $serial++;
                    } ?>
                    </tbody>
                </table>    
                <?php }else{
                    echo "!!! No Users Found !!!";
                } 
                
                echo $db->pagination('users', null, null, $limit);

                ?>    
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>