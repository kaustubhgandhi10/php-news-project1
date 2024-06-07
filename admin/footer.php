<div id="footer-admin">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    $db = new database();
                    $db->select('settings', '*', null, null);
                    $result = $db->getResult();
                    if(count($result) > 0){
                        foreach($result as $row){
                ?>
                <span><?php echo $row['footer_desc']; ?></span>
            <?php 
            }
                }
            ?>
            </div>
        </div>
    </div>
</div>
<!-- footer -->
</body>
</html>