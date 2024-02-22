<!DOCTYPE html>
<head>
    <title>Item Dashboard</title>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
    <link rel="icon" href="../images/Black-Minimalist-Initial-Font-BE-Logo-_1_.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include 'admin_header.php'; ?>

<div class="container" style="margin-top: 5%;margin-bottom:10%;">
<h1 style="color: #00afe8;" class="mb-5 text-center">ITEM DASHBOARD</h2>
    <div class="row mb-5">
        <div class="col-md-3 mb-5 text-center">
        <div class="ttext-center">
            <button onclick="window.location.href='../admin/additem.php'" class="mybtn mb-4 w-50 h-75"><img class="w-100" src="https://cdn-icons-png.flaticon.com/512/1665/1665731.png"></button>
            <br>
            <label>ADD ITEM</label>
        </div>
        </div>
        <div class="col-md-3 mb-5 text-center">
        <div class="ttext-center">
            <button onclick="window.location.href='../admin/viewitem.php'" class="mybtn mb-4 w-50 h-75"><img class="w-100" src="https://cdn-icons-png.flaticon.com/512/875/875643.png"></button>
            <br>
            <label>VIEW ITEM</label>
        </div>
        </div>
    <!-- </div>
    <div class="row my-5"> -->
        <div class="col-md-3 mb-5 text-center">
        <div class="ttext-center">
            <button onclick="window.location.href='../admin/viewitem.php'" class="mybtn mb-4 w-50 h-75"><img class="w-100" src="https://cdn-icons-png.flaticon.com/512/1001/1001259.png"></button>
            <br>
            <label>UPDATE ITEM</label>
        </div>
        </div>
        <div class="col-md-3 mb-5 text-center">
        <div class="ttext-center">
            <button onclick="window.location.href='../admin/viewitem.php'" class="mybtn mb-4 w-50 h-75"><img class="w-100" src="https://cdn-icons-png.flaticon.com/512/1215/1215092.png"></button>
            <br>
            <label>DELETE Data</label>
        </div>
        </div>
    </div>
</div>
<footer style="position:relative;top:100%"><?php include 'admin_footer.php'; ?></footer>
</body>
</html>