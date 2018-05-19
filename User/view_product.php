 <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../lib/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/css/hide.css">
    <title>Cửa hàng đồng hồ SHOP WATCH</title>

  </head>
  <body>
 
  <?php 

 // MySQLi connection
   require_once("../database/connect.php");

 //  Hien thi hang theo hang san pham
 if (!isset($_GET['page'])) {
  $_GET['page'] = 1;
 }

 $vitri = ($_GET['page'] - 1) * 2;
 if(isset($_GET['cate_id'])){
 $cate_id =$_GET['cate_id'];
 $result  = "select * from product where category_id = ".$cate_id." limit ".$vitri.",2";
 $query  = mysqli_query($con, $result);

  while ($row = mysqli_fetch_assoc($query)) {
  echo '    <img height="200" width="230" src="../Admin/Manage_Product/images/'.$row['image'].'"/><br>
    <a href="view_product_detail.php?product_id='.$row['product_id'].'"><h5>'.$row['product_name'].'</h5></a>
    <h5>Giá: '.$row['price'].'</h5>
    <h5>Cấu hình: '.$row['display'].' đ</h5>
';
 }
 
 $re = "select * from product where category_id = ".$cate_id."";
 $query =mysqli_query($con, $re); 
 $n = mysqli_num_rows($query);
 if($n % 2 == 0){
   $tong_so_trang = floor($n/2);
 }else $tong_so_trang = floor($n/2) + 1;

 if ($_GET['page'] > 1) { 
  echo '&nbsp <a href="view_product.php?cate_id='.$cate_id.'&page='.($_GET['page']-1).'">Back</a>';
   }

 for ($i = 1 ; $i <= $tong_so_trang ; $i++) {
  if ($i == $_GET['page']) {
       echo '&nbsp &nbsp'.$i.' ';
  } else {
      echo '&nbsp <a href="view_product.php?cate_id='.$cate_id.'&page='.$i.'">'.$i.'</a>';
   }
 }

if ($_GET['page'] < $tong_so_trang) { echo '&nbsp <a href="view_product.php?cate_id='.$cate_id.'&page='.($_GET['page']+1).'">Next</a>';}
}
?>
  </body>
</html>
