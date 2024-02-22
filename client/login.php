<!DOCTYPE html>
<head>
    <link rel="icon" href="../images/Black-Minimalist-Initial-Font-BE-Logo-_1_.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Labrada&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Sacramento&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in/Sign up</title>
    <style>
        .my-thittar{
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            padding: 5% 5%;
            width: 35%;
            margin: 4% auto;
        }
        .footer-pone{
            border-style: solid;
            border-color: #0e092e;
            border-radius: 5px;
            height: 20px;
        }
        .footer-pone:hover{
            border-style: solid;
            border-radius: 5px;
            border-color: white;
        }
        .footer-sar{
            text-decoration: none;
        }
        p{
          font-size: 1.1rem;
          font-family: 'Montserrat', sans-serif;
          font-weight:bolder;
        }
        .info{
          font-size: 1rem;
          font-weight: normal;
        }
        /* Phone */
        @media (max-width: 500px) {
            .my-thittar{
              width: 75%;
              margin: 45% auto;
            }
            .fartu{
              margin-top: 5%;
            }
            .caz{
              margin-bottom: 9%;
            }
        }
        /* Tablet */
        @media (min-width: 730px) and (max-width: 800px){
          .my-thittar{
              width: 50%;
              margin: 33% auto;
            }
        }
    </style>
</head>
<body>
<div class="my-thittar">
    <p class="text-center">Welcome</p>
    <!-- Pills navs -->
    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
          aria-controls="pills-login" aria-selected="true">Login</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab"
          aria-controls="pills-register" aria-selected="false">Register</a>
      </li>
    </ul>
    <!-- Pills navs -->

    <!-- Pills content -->
    <div class="tab-content">
      <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
        <form method="POST" action="checklogin.php">
          <div class="text-center my-5">
            <img width="100" src="../images/login-.gif">
          </div>
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" name="username" id="loginName" class="form-control"/>
            <label class="form-label" for="loginName">Email or username</label>
          </div>
          <!-- Password input -->
          <div class="form-outline mb-4">
            <input type="password" name="password" id="loginPassword" class="form-control"/>
            <label class="form-label" for="loginPassword">Password</label>
          </div>
          <!-- Submit button -->
          <button style="background-color: #0e092e;" type="submit" class="btn btn-block mb-4 text-white">Sign in</button>
        </form>
      </div>


      <!-- Register a pine -->
      <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
        <form method="POST" action="register.php">
            <div class="text-center">
              <p>Please Enter Your Information</p>
            </div>
            <div class="row">
                <div class="col-md-6">
                <!-- Name input -->
                    <div class="form-outline mb-4">
                      <input name="cname" type="text" id="registerName" class="form-control" required />
                      <label class="form-label" for="registerName">Name</label>
                    </div>
                </div>
                <!-- Email input -->
                <div class="col-md-6">
                    <div class="form-outline mb-4">
                      <input name="cemail" type="email" id="registerEmail" class="form-control" required />
                      <label class="form-label" for="registerEmail">Email</label>
                    </div>
                </div>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input name="cpassword" type="password" id="registerPassword" class="form-control" required />
              <label class="form-label" for="registerPassword">Password</label>
            </div>
            <!-- Repeat Password input -->
            <div class="form-outline mb-4">
              <input name="cpassword" type="password" id="registerRepeatPassword" class="form-control" required />
              <label class="form-label" for="registerRepeatPassword">Repeat password</label>
            </div>
            <!-- Address -->
            <div class="form-outline mb-4">
                <input name="caddress1" type="text" id="registerAddress" class="form-control" required />
                <label class="form-label" for="registerAddress">Address</label>
            </div>
            <div class="form-outline mb-4">
                <input name="caddress2" type="text" id="registerAddress2" class="form-control" />
                <label class="form-label" for="registerAddress2">Address 2 (Optional)</label>
            </div>
            <!-- Address -->
            <!-- City, state, zip -->
            <div class="row mb-4">
                <div class="col-md-6 caz">
                    <div class="form-outline">
                        <input name="ccity" type="text" name="ccity" class="form-control" required id="registerCity">
                        <label for="registerCity" class="form-label">City</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-outline">
                        <input name="czip" type="text" class="form-control" required id="registerZip">
                        <label for="registerZip" class="form-label">Zip</label>
                    </div>
                </div>
            </div>

            <select required name="cstate" id="inputState" class="form-select mb-4">
              <option selected>Choose State</option>
              <option>Ayeyarwady</option><option>Bago</option><option>Chin</option>
              <option>Kachin</option><option>Kayah</option><option>Kayin</option>
              <option>Magway</option><option>Mandalay</option><option>Mon</option>
              <option>Rakhine</option><option>Sagaing</option><option>Shan</option>
              <option>Tanintharyi</option><option>Yangon</option>
            </select>
            <!-- City, state, zip -->
            <!-- Payment -->
            <select name="cpayment" onchange="myFunction()" id="selectPayment" class="form-select mb-4">
              <option selected>Choose payment method</option>
              <option>Cash</option>
              <option>Mobile Banking</option>
              <option>E-Wallet</option>
            </select>
            <div id="demo">

            </div>            
            <!-- Payment -->
            <!-- Checkbox -->
            <div class="form-check d-flex justify-content-center mb-4 mt-4">
              <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked
                aria-describedby="registerCheckHelpText" required/>
              <label class="form-check-label" for="registerCheck">
                I have read and agree to the terms
              </label>
            </div>
            <!-- Submit button -->
            <button type="submit" style="background-color: #0e092e;" class="btn btn-block mb-3 text-white">Register</button>
        </form>
      </div>
      <!-- Register A pine -->
      <p class="info">If you are a wholesale customer,<a href="../client/b2blogin.php"> click here</a>.</p>
    </div>
    <!-- MDB -->
</div>
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js">
</script>
<script>
  function myFunction() {
  var x = document.getElementById("selectPayment").value;
  if(x=="Mobile Banking"){
    document.getElementById("demo").innerHTML = `
      <div class="form-outline mb-4">
        <input name="ccardnumber" type="text" id="registerCardnumber" class="form-control" />
        <label class="form-label" for="registerCardnumber">Credit Card (Eg.1111-2222-3333-4444)</label>
        </div>
        <div class="text-center">
              <p>We accept these cards</p>
            </div>
            <div class="row mb-4">
              <div class="col-lg-4 text-center">
                <img width="50" src="https://cdn-icons-png.flaticon.com/512/196/196578.png">
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