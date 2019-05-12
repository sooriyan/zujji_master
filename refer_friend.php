<?php
require_once('user_navbar.php');

?>
  <div class=" col-sm-2 col-lg-1 col-md-1 col-xs-12"></div>
  <div class=" col-sm-8 col-lg-10 col-md-10 col-xs-12">
    <div class="a1 container-fluid" style="height: 100%;background-color: #E0E0D1">
      <h3 class="jumbotron">Welcome, <?php echo $_SESSION['user']['fname'];?> <div class="pull-right">Credits <span class="badge"><?php echo $_SESSION['user']['credits'];?></span></div></h3>
      <br>
      <div><h2>Refer Friends And Earn Credits</h2></div>
      <br>
      <form method="post" action="dbactions.php">
        <input type="email" placeholder="Email" class="form-control mail1" name="mail1"><br>
        <input type="email" placeholder="Email" class="form-control mail2" name="mail2"><br>
        <input type="email" placeholder="Email" class="form-control mail3" name="mail3"><br>
        <input type="email" placeholder="Email" class="form-control mail4" name="mail4"><br>
        <input type="email" placeholder="Email" class="form-control mail5" name="mail5"><br>
        <div class="col-lg-1 pull-right"><button class="btn btn-info refer_sub" type="submit" value="refer_friend" name="submit">Refer</button></div>
      </form>
      </div>
    </div>
  </div>
<div class=" col-sm-2 col-lg-1 col-md-1 col-xs-12"></div>
</div>
</body>
</html>