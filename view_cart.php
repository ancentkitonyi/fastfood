<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Anc's Fast Food</title>

  <!-- css -->
  <link href='https://fonts.googleapis.com/css?family=Great Vibes' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="css/all.css">
  <link rel="stylesheet" type="text/css" href="css/foundation.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css.map">
  <link rel="icon" href="img/logo2.png">
  <link href="css/style.css" rel="stylesheet" type="text/css" media="all">

  <!-- script -->
  <script src="js/jquery-3.5.1.min.js"></script>  
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/all.js"></script>
  <script type="text/javascript" src="js/foundation.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
</head>
<body style="background-color: #000;">
<nav class="navbar navbar-dark">
  <a class="navbar-brand" href="#">
    <img src="img/logo3.png" width="70" height="50" class="d-inline-block" alt="" loading="lazy">
    Anc's Fast Food
  </a>
  <div class="nav-item" style="background-color: #000;">
    <a class="nav-link" href="view_cart.php"><span class="badge"><?php echo count($_SESSION['cart']); ?></span>Cart <i class="fa fa-shopping-cart" style="color: #fcba03" aria-hidden="true"></i></a>
  </div>
</nav>
<div class="container">
  <h1 class="page-header text-center" style="color: #fff;">Cart Details</h1>
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <?php 
      if(isset($_SESSION['message'])){
        ?>
        <div class="alert alert-info text-center">
          <?php echo $_SESSION['message']; ?>
        </div>
        <?php
        unset($_SESSION['message']);
      }

      ?>
      <form method="POST" action="save_cart.php">
      <table class="table table-bordered table-striped">
        <thead>
          <th></th>
          <th>Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Subtotal</th>
        </thead>
        <tbody>
          <?php
            //initialize total
            $total = 0;
            if(!empty($_SESSION['cart'])){
            //connection
            $conn = new mysqli('localhost', 'root', '', 'project');
            //create array of initail qty which is 1
            $index = 0;
            if(!isset($_SESSION['qty_array'])){
              $_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
            }
            $sql = "SELECT * FROM food WHERE fid IN (".implode(',',$_SESSION['cart']).")";
            $query = $conn->query($sql);
              while($row = $query->fetch_assoc()){
                ?>
                <tr>
                  <td>
                    <a href="delete_item.php?fid=<?php echo $row['fid']; ?>&index=<?php echo $index; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-2x"></i></a>
                  </td>
                  <td><?php echo $row['fname']; ?></td>
                  <td><?php echo number_format($row['fprice'], 2); ?></td>
                  <input type="hidden" name="indexes[]" value="<?php echo $index; ?>">
                  <td><input type="number" class="form-control" value="<?php echo $_SESSION['qty_array'][$index]; ?>" name="qty_<?php echo $index; ?>"></td>
                  <td><?php echo number_format($_SESSION['qty_array'][$index]*$row['fprice'], 2); ?></td>
                  <?php $total += $_SESSION['qty_array'][$index]*$row['fprice']; ?>
                </tr>
                <?php
                $index ++;
              }
            }
            else{
              ?>
              <tr>
                <td colspan="5" class="text-center">No Item in Cart</td>
              </tr>
              <?php
            }

          ?>
          <tr>
            <td colspan="4" align="right"><b>Total</b></td>
            <td><b><?php echo number_format($total, 2); ?></b></td>
          </tr>
        </tbody>
      </table>
      <a href="index.php#mymenu" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
      <a href="clear_cart.php" class="btn btn-danger"><i class="fa fa-trash"></i> Clear Cart</a>
      <button type="submit" class="btn btn-success" name="save"><i class="fa fa-save"></i> Update Cart to proceed</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>