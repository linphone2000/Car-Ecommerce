<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
<link rel="icon" href="../images/Black-Minimalist-Initial-Font-BE-Logo-_1_.ico">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<?php
include "../admin/connection.php";
$sql = "SELECT * FROM customer";
$sq = $db->prepare($sql);
$sq ->execute();
?>
<h1 class="text-center">Customer Table</h1>
<table class="table table-hover">
    <tr>
      <th>Customer ID</th>
      <th>Customer name</th> 
      <th>Customer email</th>
      <th>Customer Payment</th>
      <th>Address 1</th>
      <th>Address 2</th>
      <th>City</th>
      <th>State</th>
      <th>Zip</th>
</tr>
<?php
while($row=$sq->fetch(PDO::FETCH_ASSOC)){
    extract($row);?>
    <tr>
        <td><?php echo $cid;?></td>
        <td><?php echo $cname;?></td>
        <td><?php echo $cemail;?></td>
        <td><?php echo $cpayment;?></td>
        <td><?php echo $caddress1;?></td>
        <td><?php echo $caddress2;?></td>
        <td><?php echo $ccity;?></td>
        <td><?php echo $cstate;?></td>
        <td><?php echo $czip;?></td>
    </tr>
<?php
}
?>
</table>
<div class="col-md-12 text-center">
<button class="btn btn-dark" onclick="window.location.href='../admin/main.php';">Back</button>
</div>