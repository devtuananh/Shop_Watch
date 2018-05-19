<!DOCTYPE html>
<html>
<head>
  <title></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
    <br>
    <button type="button" class="btn-lg btn-default" aria-label="Left Align"><a href="../index.php"><b style="font-family: 'Roboto Slab', serif; color:#660033">Trang chủ</b></a>  
    
    </button>
    <br><br>
<?php 

 // MySQLi connection
   require_once("../database/connect.php");

 //  Hien thi hang theo hang san pham
 if (!isset($_GET['page'])) {
  $_GET['page'] = 1;
 }

 $vitri = ($_GET['page'] - 1) * 2;

 if(empty($_GET['key']))
  echo "Ban chua nhap";
 
 else
 {
 $key =$_GET['key'];
/* or price <= ".$key." order by price desc*/
if (is_numeric($key)) {
   $result  = "select * from product where price <= ".$key." order by price desc limit ".$vitri.",2";
}else{
  $result  = "select * from product where product_name like '%$key%'  limit ".$vitri.",2";
}
  $query  = mysqli_query($con, $result);
  while ($row = mysqli_fetch_assoc($query)) {
  echo '   
 <table>
  <tr>
    <td><img height="200" width="230" src="../Admin/Manage_Product/images/'.$row['image'].'"/></td>
  </tr>
  <tr>
    <td align="center"><a href="view_product_detail.php?product_id='.$row['product_id'].'"><h5>'.$row['product_name'].'</h5></a></td>
  </tr>
  <tr>
    <td align="center"><h5>Giá: '.$row['price'].' đ</h5></td>
  </tr>
</table>';
 }
 if (is_numeric($key)) {
 $re = "select * from product where price <= ".$key." order by price desc";
}else{
 $re = "select * from product where product_name like '%$key%'";
}
 $query =mysqli_query($con, $re); 
 $n = mysqli_num_rows($query);
 if($n % 2 == 0){
   $tong_so_trang = floor($n/2);
 }else $tong_so_trang = floor($n/2) + 1;

 if ($_GET['page'] > 1) { 
  echo '&nbsp <a href="find_product.php?key='.$key.'&page='.($_GET['page']-1).'">Back</a>';
   }

 for ($i = 1 ; $i <= $tong_so_trang ; $i++) {
  if ($i == $_GET['page']) {
       echo '&nbsp &nbsp'.$i.' ';
  } else {
      echo '&nbsp <a href="find_product.php?key='.$key.'&page='.$i.'">'.$i.'</a>';
   }
 }

if ($_GET['page'] < $tong_so_trang) { echo '&nbsp <a href="find_product.php?key='.$key.'&page='.($_GET['page']+1).'">Next</a>';}
}

?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

</body>
</html>
  

