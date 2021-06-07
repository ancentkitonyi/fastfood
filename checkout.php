<?php
session_start()
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
<body style="background-color: #000; color: #fff;">
<nav class="navbar navbar-dark">
  <a class="navbar-brand" href="#">
    <img src="img/logo3.png" width="70" height="50" class="d-inline-block" alt="" loading="lazy">
    Anc's Fast Food
  </a>
</nav>
<div class="container">
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
  </div>
  <form method="POST">
  <div class="receipt" style="background-color: #fff; color: #000;">
    <div class="receipt-header">
      <div class="receipt-address" style="padding: 5%">
      <div class="row">
      <div class="col-md-6">
          <address>
              <strong><em>Anc's Fast Food</em></strong>
              <br>
              <em>Magadi Road at Masai loadge stage</em>
              <br>
              <em>Ongata Rongai, Kajiado.</em>
              <br>
              <em>+254700000000</em>
          </address>
      </div>
      <div class="col-sm-6 col-md-6">
          <p><em><script>var theDate=new Date();
                          document.write(theDate);
          </script></em></p>
          <p><em>Receipt #: <?php
                $receipt = rand(100000,999999);
                echo $receipt;
          ?></em></p>
      </div>
      </div>
    </div>
      <div class="text-center">
          <h1>Receipt</h1>
      </div>
    </div>
    <div class="receipt-body" style="padding: 5%">
      <table class="table">
        <thead>
          <th>Food</th>
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
                  <td><em><?php echo $row['fname']; ?></em></h4></td>
                  <td>Ksh. <?php echo number_format($row['fprice'], 2); ?></td>
                  <td><?php echo $_SESSION['qty_array'][$index]; ?></td>
                  <td>Ksh. <?php echo number_format($_SESSION['qty_array'][$index]*$row['fprice'], 2); ?></td>
                  <?php $total += $_SESSION['qty_array'][$index]*$row['fprice']; ?>
                </tr>
                <?php
                $index ++;
              }
            }
            else{
              ?>
              <tr>
                <td colspan="4" class="text-center">No Item in Cart</td>
              </tr>
              <?php
            }
          ?>
          <tr>
            <td colspan="3" class="text-right"><h4><strong>Total</strong></h4></td></td>
            <td class="text-danger"><h4><strong>Ksh. <?php echo number_format($total, 2); ?></strong></h4></td></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  </form>
  <div style="padding: 1%;">
    <a href="view_cart.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
  </div>
  
  <div class="payment-details">
    <h1 class="heading text-center">Payment Method</h1>
    <!-- Nav pills -->
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="pill" href="#cash">Cash</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="pill" href="#credit">Credit Card</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="pill" href="#mpesa">Mpesa</a>
      </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane container active" id="cash">
        <div class="card col-md-6" style="margin-top: 2%;">
          <div class="card-header">
            <i class="fa fa-money-check fa-2x" aria-hidden="true"></i>
          </div>
          <div class="card-body">
            <?php if(isset($_POST['cash']))
              {  
                 $cash_name = $_POST['cash_name'];
                 $receipt = $_POST['receipt'];
                 $amount = $_POST['amount'];
                 $sql= "INSERT INTO orders_cash(name, receipt, amount) VALUES ('$cash_name', '$receipt', '$amount')";
                 if (mysqli_query($conn, $sql)) {
                  unset($_SESSION['cart']);
                  echo '<script>window.location="thank-you.php"</script>';
                 } else {
                  echo "Error: " . $sql . "" . mysqli_error($conn);
                 }
                 mysqli_close($conn);
              }
            ?>
            <form method="POST">
              <div class="input-container">
                 <i class="fa fa-user fa-2x icon"></i>
                 <input class="input-field" type="text" placeholder="Name" name="cash_name" required>
              </div>
              <div class="row" style="padding: 0;">
              <div class="input-container col-md-6">
                <i class="fa fa-receipt fa-2x icon"></i>
                <input class="input-field" type="text" value="<?php echo $receipt ?>" name="receipt" readonly>
              </div>
              <div class="input-container col-md-6">
                <i class="fa fa-money-check fa-2x icon"></i>
                <input class="input-field" type="number" value="<?php echo number_format($total, 2); ?>" name="amount" readonly>
              </div>
              </div>
              <button type="submit" class="send" name="cash">Pay Now</button>
            </form>
          </div>
        </div>
      </div>

      <div class="tab-pane container fade" id="credit">
        <div class="card col-md-6" style="margin-top: 2%;">
          <div class="card-header">
            <i class="fab fa-cc-visa fa-2x" aria-hidden="true" style="color:navy;"></i>
            <i class="fab fa-cc-mastercard fa-2x" style="color:red;"></i>
          </div>
          <div class="card-body">
          <?php if(isset($_POST['pay']))
            {  
               $card_name = $_POST['card_name'];
               $card_number = $_POST['card_number'];
               $month =  $_POST['month'];
               $year = $_POST['year'];
               $card_code = $_POST['card_code'];
               $receipt = $_POST['receipt'];
               $amount = $_POST['amount'];
               $sql= "INSERT INTO orders_card(name, card_number, month, year, cv_code, receipt_number, amount) VALUES ('$card_name','$card_number','$month','$year','$card_code', '$receipt', '$amount')";
               if (mysqli_query($conn, $sql)) {
                unset($_SESSION['cart']);
                echo '<script>window.location="thank-you.php"</script>';
                die();
               } else {
                echo "Error: " . $sql . "" . mysqli_error($conn);
               }
               mysqli_close($conn);
            }
          ?>
            <form action="" method="POST">
                 <div class="input-container">
                  <i class="fa fa-user fa-2x icon"></i>
                  <input class="input-field" type="text" placeholder="Card OwnerName" name="card_name" required>
                </div>
                <div class="input-container">
                  <i class="fa fa-credit-card fa-2x icon"></i>
                  <input class="input-field" type="number" placeholder="Valid Card Number" name="card_number" required>
                </div>
                <div class="row" style="padding: 0;">
                <div class="input-container col-md-6">
                  <i class="fa fa-calendar fa-2x icon"></i>
                  <input class="input-field" type="number" placeholder="MM" name="month" min="1" max="12" required>
                  <input class="input-field" type="number" placeholder="YYYY" name="year" min="2000" max="3000" required>
                </div>
                <div class="input-container col-md-6">
                  <i class="fa fa-key fa-2x icon"></i>
                  <input class="input-field" type="number" placeholder="CV Code: last 3 digits" name="card_code" required>
                </div>
                </div>
                <div class="row" style="padding: 0;">
                <div class="input-container col-md-6">
                  <i class="fa fa-receipt fa-2x icon"></i>
                  <input class="input-field" type="text" value="<?php echo $receipt ?>" name="receipt" readonly>
                </div>
                <div class="input-container col-md-6">
                  <i class="fa fa-money-check fa-2x icon"></i>
                  <input class="input-field" type="number" value="<?php echo number_format($total, 2); ?>" name="amount" readonly>
                </div>
                </div>
                <button type="submit" class="send" name="pay">Pay Now</button>
            </form>
          </div>
          <div class="card-footer">
            <div class="alert alert-success" role="alert">
              Your order will be processed after the amount is credited to us.
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane container fade" id="mpesa">
          <div class="card col-md-6" style="margin-top: 2%">
            <div class="card-header">
              <img src="img/mpesa.png" width="100" height="50">
            </div>
            <div class="card-body">
              <?php if(isset($_POST['mpesa']))
                {  
                   $mpesa_name = $_POST['mpesa_name'];
                   $phone_number = $_POST['phone_number'];
                   $receipt = $_POST['receipt'];
                   $amount = $_POST['amount'];
                   $sql= "INSERT INTO orders_mpesa(name, phone, receipt, amount) VALUES ('$mpesa_name','$phone_number', '$receipt', '$amount')";
                   if (mysqli_query($conn, $sql)) {
                    unset($_SESSION['cart']);
                    echo '<script>window.location="thank-you.php"</script>';
                   } else {
                    echo "Error: " . $sql . "" . mysqli_error($conn);
                   }
                   mysqli_close($conn);
                }
              ?>
              <form action="" method="POST">
                <div class="input-container">
                  <img src="img/mpesa.png" height="30" width="50">
                  <input class="input-field" type="text" value="Buy Goods till number: 000000" readonly>
                </div>
                <div class="input-container">
                   <i class="fa fa-user fa-2x icon"></i>
                   <input class="input-field" type="text" placeholder="Full Names" name="mpesa_name" required>
                </div>
                <div class="input-container">
                  <i class="fa fa-phone fa-2x icon"></i>
                  <input class="input-field" type="tel" placeholder="XXXXXXXXXX" name="phone_number" pattern="[0-9]{10}" required>
                </div>
                <div class="row" style="padding: 0;">
                <div class="input-container col-md-6">
                  <i class="fa fa-receipt fa-2x icon"></i>
                  <input class="input-field" type="text" value="<?php echo $receipt ?>" name="receipt" readonly>
                </div>
                <div class="input-container col-md-6">
                  <i class="fa fa-money-check fa-2x icon"></i>
                  <input class="input-field" type="number" value="<?php echo number_format($total, 2); ?>" name="amount" readonly>
                </div>
                </div>
                <button type="submit" class="send" name="mpesa">Pay Now</button>
              </form>
            </div>
            <div class="card-footer">
              <div class="alert alert-success" role="alert">
                Your order will be processed after we receive confirmation details.
              </div>
            </div>
          </div>
      </div>
    </div>
    </div>
  </div>
</div>
</body>
</html>