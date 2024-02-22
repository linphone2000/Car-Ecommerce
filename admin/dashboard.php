<!DOCTYPE html>
<head>
    <title>Admin Dashboard</title>
    <link rel="icon" href="../images/Black-Minimalist-Initial-Font-BE-Logo-_1_.ico">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include 'admin_header.php'; ?>

<div class="container" style="margin-top: 8%;">
    <div class="row" style="margin-bottom: 5%;">
        <div class="col-lg-4 col-md-12 mb-5 text-center">
        <div class="ttext-center">
            <button onclick="window.location.href='../admin/dashboard_item.php'" class="mybtn mb-4 w-50 h-75"><img class="w-100" src="https://cdn-icons-png.flaticon.com/512/6137/6137049.png"></button>
            <br>
            <label>ITEM DASHBOARD</label>
        </div>
        </div>
        <div class="col-lg-4 col-md-12 mb-5 text-center">
        <div class="ttext-center">
            <button onclick="window.location.href='../admin/dashboard_user.php'" class="mybtn mb-4 w-50 h-75"><img class="w-100" src="https://cdn-icons-png.flaticon.com/512/747/747959.png"></button>
            <br>
            <label>USER DASHBOARD</label>
        </div>
        </div>
    <!-- </div>
    <div class="row my-5"> -->
        <div class="col-lg-4 col-md-12 mb-5 text-center">
        <div class="ttext-center">
            <button onclick="window.location.href='../admin/dashboard_order.php'" class="mybtn mb-4 w-50 h-75"><img class="w-100" src="https://cdn-icons-png.flaticon.com/512/747/747896.png"></button>
            <br>
            <label>ORDER DASHBOARD</label>
        </div>
        </div>
    </div>
</div>

<footer style="margin-top:10%;"><?php include 'admin_footer.php'; ?></footer>
</body>
</html>