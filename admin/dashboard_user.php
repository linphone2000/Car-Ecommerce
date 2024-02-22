<!DOCTYPE html>
<head>
    <title>User Dashboard</title>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
    <link rel="icon" href="../images/Black-Minimalist-Initial-Font-BE-Logo-_1_.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include 'admin_header.php'; ?>

<div class="container" style="margin-top: 8%;">
    <div class="row" style="margin-bottom: 5%;">
        <div class="col-md-4 mb-5 text-center">
        <div class="ttext-center">
            <button onclick="window.location.href='../admin/viewuser.php'" class="mybtn mb-4 w-50 h-75"><img class="w-100" src="https://cdn-icons-png.flaticon.com/512/5692/5692095.png"></button>
            <br>
            <label>VIEW USER</label>
        </div>
        </div>
        <div class="col-md-4 mb-5 text-center">
        <div class="ttext-center">
            <button onclick="window.location.href='../admin/viewuser.php'" class="mybtn mb-4 w-50 h-75"><img class="w-100" src="https://cdn-icons-png.flaticon.com/512/8566/8566347.png"></button>
            <br>
            <label>VIEW USER'S ORDER</label>
        </div>
        </div>
    <!-- </div>
    <div class="row my-5"> -->
        <div class="col-md-4 mb-5 text-center">
        <div class="ttext-center">
            <button onclick="window.location.href='../admin/viewuser.php'" class="mybtn mb-4 w-50 h-75"><img class="w-100" src="https://cdn-icons-png.flaticon.com/512/747/747969.png"></button>
            <br>
            <label>DELETE USER</label>
        </div>
        </div>
    </div>
</div>

<footer style="margin-top:10%;"><?php include 'admin_footer.php'; ?></footer>
</body>
</html>