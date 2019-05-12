<?php
require_once('admin_navbar.php');
?>

<div class="container">
    <div class="row">
    <div class=" col-sm-2 col-lg-3 col-md-3 col-xs-12"></div>


<div class=" col-sm-8 col-lg-6 col-md-6 col-xs-12">
   

    <form style="margin-top:50px;" method="post" class="form-group" action="adminactions.php">
        
        <span class="text_center"><h3 style="margin-top:0px; padding:10px 0px;">Add New Category</h3></span>
        <?php
            if(isset($_SESSION['successmsg'])){
                echo $_SESSION['successmsg'];
                unset($_SESSION['successmsg']);
            }
            elseif (isset($_SESSION['errormsg'])) {
                echo $_SESSION['errormsg'];
                unset($_SESSION['errormsg']);
            }
        ?>
        <div class="row">
            <div class="col-md-3">
                Category Name
            </div>
            <div class="col-md-6">
                <input type="text" name="category_name" class="form-control" placeholder="Category name" required/><br>
            </div>
        </div>
        <br>
        <div class="row">
        <div class="text-center"><button type="submit" id="reg" name="submit" class="btn btn-primary" value="add_category">Add</button></div></div><br><br>
    </form>
        <!-- </div> -->
</div>
</div>
<div class=" col-sm-2 col-lg-3 col-md-3 col-xs-12"></div>
        
    </div>
</div>
</body>
</html>