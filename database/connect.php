<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));  

$con = mysqli_connect("localhost","root","","shop_clock");
mysqli_set_charset($con,"utf8");
if (mysqli_connect_errno())
  {
  echo "MySQLi Connection was not established: " . mysqli_connect_error();
  }
?>
