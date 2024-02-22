<?php
include "../admin/connection.php";
$sql = "SELECT * FROM myorder";
$sq = $db->prepare($sql);
$sq ->execute();
?>
<html>
<head>
    <title>Order Table</title>
    <link rel="icon" href="../images/Black-Minimalist-Initial-Font-BE-Logo-_1_.ico">
</head>
<body>
<!-- Header -->
<?php include 'header.php' ?>
<!-- Header -->
<div style="height: 10%;">
</div>
<table class="table table-hover" style="height: 55%;">
<tbody class="text-center">
<tr>
      <th class="text-center">Name</th> 
      <th class="text-center">Quantity</th>
      <th class="text-center">Price</th>
</tr>
<?php
while($row=$sq->fetch(PDO::FETCH_ASSOC)){
    extract($row);?>
    <?php $total = $total + $price; ?>
    <tr class="text-center">
        <td><?php echo $oname;?></td>
        <td><?php echo $quantity;?></td>
        <td><?php echo $price;?></td>
    </tr>
<?php
}
?>
<tr class="text-center">
<td></td>
<td>Total: </td>
<td><?php $total; ?></td>
</tbody>
</table>

<!-- Footer -->
<div style="margin-top: 5%; width:100%;">
  <?php include 'footer.php'; ?>
</div>
<!-- Footer -->
</body>
</html>