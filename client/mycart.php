<?php
include '../admin/connection.php';
?>
<html>
<head>
  <title>Cart</title>
  <link rel="icon" href="../images/Black-Minimalist-Initial-Font-BE-Logo-_1_.ico">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
  <link rel="icon" href="../images/Black-Minimalist-Initial-Font-BE-Logo-_1_.ico">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{
        background-color: #ecf2ff;
        /* ecfaff */
    }
    .button_style{
        top: 0px;
        margin-top: 15px;
        margin-bottom: 15px;
	      background: #fff;
        font-size: 14px;
        border-radius: 26px;
        border: 1px solid #D4D3E8;
        text-transform: uppercase;
        font-weight: 700;
        align-items: center;
        top: 10px;
        width: 150px;
        height: 50px;
        color: #544bb3;
        box-shadow: 0px 2px 2px #544bb3;
        cursor: pointer;
        transition: .2s;
        position: relative;
    }
    .button_style:active,
    .button_style:focus,
    .button_style:hover {
	    border-color: #3b25b3;
      background-color: #3b25b3;
      color: white;
	    width: 160px;
	    outline: none;
    }
    .ttext-center{
        /* ECF2FF */
        background-color: #ecfaff;
        border-radius: 10px;
        padding-top: 15px;
        padding-bottom: 15px;
        margin: 15px auto 15px auto;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
        transition: .5s;
    }
    .ttext-center:hover{
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
    }
    .ttd{
        padding-left: 10px;
        padding-right: 10px;
        transition: 0.2s;
    }
    .ttd:hover{
        background-color: #ecf2ff;
        outline:none;
    }
    .nt{
      position: relative;
      height: 100%;
      top: 0%;
    }
    .fartu{
      margin-top: 20%; width:100%;
    }
    .form-control{
      color: #D6D6D6;
    }
    @media (max-width: 500px){
      .fartu{
        margin-top: 60%;
      }
    }
    @media (min-width: 730px) and (max-width: 800px){
      .fartu{
        margin-top: 56%;
      }
    }
  </style>
</head>
<body>
  <?php
  include 'header.php';
  ?>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center border rounded bg-light my-5">
        <h1>My Cart</h1>
      </div>
<!--table -->
      <div class="col-lg-9 table-responsive">
        <table class="table">
          <thead class="text-center">
            <tr>
              <th scope="col">Serial No.</th>
              <th scope="col">Name </th>
              <th scope="col">Price</th>
              <th scope="col">Quantity</th>
              <th scope="col">Photo</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <?php 
            if(isset($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $key => $product){ ?>
            <tr>
              <td><?php echo $key+1;?></td>
              <td><?php echo $product['name']; ?></td>
              <td><?php echo "$".$product['price']; ?></td>
              <td>
                <form class="toreduce" method="POST" action="managecart.php">
                  <button class="minus-button" name="remove"><img class="minus-pone" src="https://cdn-icons-png.flaticon.com/512/9679/9679562.png"></button>
                  <?php echo $product['quantity']; ?>
                  <input type="hidden" name="fname" value="<?php echo $product['name']; ?>" >
                  <button class="plus-button" name="add"><img class="plus-pone" src="https://cdn-icons-png.flaticon.com/512/1828/1828819.png"></button>
                </form>
              </td>
              <td>
                  <img height="45px" src="../images/<?php echo $product['image']; ?>">
                    <?php 
                      $total = $product['price'] * $product['quantity'];
                      $whole_total = $total+$whole_total;
                    ?>
              </td>
              <td><?php echo "$".$product['price'] * $product['quantity']; ?></td>
            </tr>
            <?php 
              } //End For Each
            } // End if
            ?>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <?php if($whole_total!=0){ ?>
              <td>Sub Total:</td>
              <td></td>
              <td><?php echo '$'.$whole_total; ?></td>  
              <?php } ?>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- box -->
      <div class="col-lg-3">
        <div class="border bg-light rounded text-center p-4">
          <h4>Total: <?php echo '$'.$whole_total; ?></h4>
          <h5 id="gtotal"></h5>
          <button class="button_style" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Checkout</button>
        
          <!-- Checking -->
          <?php if($_SESSION['username']==null) {?>
          <div class="container-fluid">
              <div style="width:99%;height: 100%;background-color:#0e092e;" class="offcanvas offcanvas-bottom text-white" data-bs-scroll="false" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header text-center pb-0">
                  <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Please enter your information and check your order carefully!</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
            <form method="POST" action="order_insert.php" class="row g-3 text-center" style="margin: 1.5% 25%">
                <div class="col-md-6">
                  <label for="inputEmail4" class="form-label">Name</label>
                  <input type="text" name="cname" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-6">
                  <label for="inputEmail4" class="form-label">Email</label>
                  <input type="email" name="cemail" class="form-control" id="inputEmail4">
                </div>
              <div class="col-md-12">
                <label for="inputState" class="form-label">Payment</label>
                <select name="cpayment" onchange="myFunction()" id="selectPayment" class="form-select">
                  <option selected>Choose payment method</option>
                  <option>Cash</option>
                  <option>Mobile Banking</option>
                  <option>E-Wallet</option>
                </select>
              </div>
              <div class="col-md-12" id="demo">

              </div> 
              <div class="col-6">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" name="caddress1" class="form-control" id="inputAddress" placeholder="1234 Main St">
              </div>
              <div class="col-6">
                <label for="inputAddress2" class="form-label">Address 2</label>
                <input type="text" name="caddress2" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
              </div>
              <div class="col-md-4">
                <label for="inputCity" class="form-label">City</label>
                <input type="text" name="ccity" class="form-control" id="inputCity">
              </div>
              <div class="col-md-4">
                <label for="inputState" class="form-label">State</label>
                <select name="cstate" id="inputState" class="form-select">
                  <option selected>Choose...</option>
                  <option>Ayeyarwady</option><option>Bago</option><option>Chin</option>
                  <option>Kachin</option><option>Kayah</option><option>Kayin</option>
                  <option>Magway</option><option>Mandalay</option><option>Mon</option>
                  <option>Rakhine</option><option>Sagaing</option><option>Shan</option>
                  <option>Tanintharyi</option><option>Yangon</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="inputZip" class="form-label">Zip</label>
                <input name="czip" type="text" class="form-control" id="inputZip">
              </div>

              <div class="col-12">
                <button type="submit" class="button_style">CONFIRM</button>
              </div>
              <?php if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $key => $product){ ?>
                  <input type="hidden" name="oname" value="<?php echo $product['name']; ?>">
                  <input type="hidden" name="oprice" value="<?php echo $product['price']; ?>">
                  <input type="hidden" name="oquantity" value="<?php echo $product['quantity']; ?>">
                <?php 
                  } //end foreach
                } //end if
                ?>
                <?php if($whole_total!=0){ ?>
                  <input type="hidden" name="ototalprice" value="<?php echo $whole_total; ?>">
              <?php } ?>
            </form>
            <!-- oc-b -->
            <?php include '../admin/footer.php'; ?>
          </div>
          </div>
          <?php }?>
        <!-- Checking -->

        <!-- Another Checking -->
        <?php
        if(isset($_SESSION['username'])){
          $nametouse = $_SESSION['username'];
          $sql1 = "SELECT * FROM customer WHERE cemail='$nametouse'";
          $sq1 = $db->prepare($sql1);
          $sq1 ->execute();
          $row=$sq1->fetch(PDO::FETCH_ASSOC);
          extract($row);
        ?>
        <div style="height: 90%;background-color:#0e092e;" class="offcanvas offcanvas-bottom text-white" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
          <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Please check your delivery information!</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <form method="POST" action="userorder.php" class="row g-3 text-center" style="padding: 0% 25%">
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Name</label>
              <fieldset disabled>
                <input type="text" value="<?php echo $cname ?>"  class="form-control">
              </fieldset>
            </div>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Email</label>
              <fieldset disabled>
                <input type="email" value="<?php echo $cemail ?>" class="form-control">
              </fieldset>
            </div>
            <div class="col-md-12">
              <label for="inputState" class="form-label">Payment</label>
              <fieldset disabled>
                <input type="text" value="<?php echo $cpayment ?>" class="form-control">
              </fieldset>
            </div> 
            <div class="col-6">
              <label for="inputAddress" class="form-label">Address 1</label>
              <fieldset disabled>
                <input type="text" value="<?php echo $caddress1 ?>" class="form-control">
              </fieldset>
            </div>
            <div class="col-6">
              <label for="inputAddress" class="form-label">Address 2</label>
              <fieldset disabled>
                <input type="text" value="<?php echo $caddress2 ?>" class="form-control">
              </fieldset>
            </div>
            <div class="col-md-4">
              <label for="inputCity" class="form-label">City</label>
              <fieldset disabled>
                <input type="text" value="<?php echo $ccity ?>" class="form-control">
              </fieldset>
            </div>
            <div class="col-md-4">
              <label for="inputState" class="form-label">State</label>
              <fieldset disabled>
                <input type="text" value="<?php echo $cstate ?>" class="form-control">
              </fieldset>
            </div>
            <div class="col-md-4">
              <label for="inputZip" class="form-label">Zip</label>
              <fieldset disabled>
                <input type="text" value="<?php echo $czip ?>" class="form-control">
              </fieldset>
            </div>
            <div class="col-12 mt-0">
              <button type="submit" class="button_style">CONFIRM</button>
            </div>
          </form>
          <!-- oc-b -->
          <?php include '../admin/footer.php'; ?>
        </div>
        <?php } ?>
        <!-- Another Checking -->

          </div>
        </div>
      </div>
    </div>
  <!-- footer -->
  <div class="fartu">
  <?php include 'footer.php'; ?>
  </div>
  <script src="../bootstrap/js/bootstrap.bundle.js"></script>
  <script>
    function myFunction() {
    var x = document.getElementById("selectPayment").value;
    if(x=="Mobile Banking"){
      document.getElementById("demo").innerHTML = `
          <div class="col-md-12">
            <label for="inputState" class="form-label">Credit Card</label>
            <input type="text" name="ccardnumber" class="form-control" id="inputCard">
          </div>
          <div class="text-center">
                <p>We accept these cards</p>
              </div>
              <div class="row">
                <div class="col-lg-4 text-center">
                  <img width="50" src="https://cdn-icons-png.flaticon.com/512/5968/5968299.png">
                </div>
                <div class="col-lg-4 text-center">
                  <img width="50" src="https://brandslogo.net/wp-content/uploads/2016/07/mastercard-vector-logo.png">
                </div>
                <div class="col-lg-4 text-center">
                  <img width="50" src="https://cdn-icons-png.flaticon.com/512/5968/5968341.png">
                </div>
              </div>`;
    }
    else if(x=="E-Wallet"){
      document.getElementById("demo").innerHTML = `
          <div class="col-md-12">
            <label for="inputState" class="form-label">E-Wallet Phone</label>
            <input type="text" name="ccardnumber" class="form-control" id="inputCard">
          </div>
          <div class="text-center">
                <p>We accept these payments</p>
              </div>
              <div class="row">
                <div class="col-lg-4 text-center">
                  <img width="50" src="../images/wavepay.png">
                </div>
                <div class="col-lg-4 text-center">
                  <img width="50" src="../images/ayapay.png">
                </div>
                <div class="col-lg-4 text-center">
                  <img width="50" src="../images/kpay.png">
                </div>
              </div>`;
    }
    else{
      document.getElementById("demo").innerHTML = "";
    }
    }
  </script>
</body>
</html>