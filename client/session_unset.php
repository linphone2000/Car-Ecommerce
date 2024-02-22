<?php
session_start();
session_destroy();
echo"<script>alert('Logged Out!');window.location.href = '../client/clientpage.php';</script>";
?>