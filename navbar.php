<?php include('conn.php'); ?>
<nav class="navbar fixed-top navbar-expand-lg navbar-default scrolling-navbar main-navbar">
  <a class="navbar-brand" href="#">
    <img src="img/logo3.png" width="70" height="50" class="d-inline-block" alt="" loading="lazy">
    Anc's Fast Food
  </a>
  <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="nav navbar-nav ml-auto main-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">HOME <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#about">ABOUT US</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#mymenu">MENU</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#team">TEAM</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#contact">CONTACT</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="view_cart.php"><span class="badge"><?php echo count($_SESSION['cart']); ?></span>Cart <i class="fa fa-shopping-cart" style="color: #fcba03" aria-hidden="true"></i></a>
      </li>
    </ul>
  </div>
    <?php
    //info message
    if(isset($_SESSION['message'])){
      ?>
      <div class="row">
        <div class="col-sm-6 col-sm-offset-6">
          <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
          </div>
        </div>
      </div>
      <?php
      unset($_SESSION['message']);
    }
    ?>
</nav>
