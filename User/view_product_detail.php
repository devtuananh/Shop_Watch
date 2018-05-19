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
 
 require_once("../database/connect.php");

 if(isset($_GET['product_id'])){
 $product_id =$_GET['product_id'];
 $result  = "select * from product join category on product.category_id = category.category_id where product_id = ".$product_id."";
 $query  = mysqli_query($con, $result);
 $row = mysqli_fetch_assoc($query);
  echo '
  <h5><b>THÔNG TIN CHI TIẾT ĐỒNG HỒ </b></h5>
  <table>
  <tr>
    <td><img height="200" width="230" src="../Admin/Manage_Product/images/'.$row['image'].'"/></td>
  </tr>
  <tr>
    <td align="left"><h5>Tên sản phẩm: '.$row['product_name'].'</h5></td>
  </tr>
    <tr>
    <td align="left"><h5>Giá: '.$row['price'].' đ</h5></td>
  </tr>
  <tr>
    <td align="left"><h5>Hãng: '.$row['category_name'].'</h5></td>
  </tr>  
  <tr>
    <td align="left"><h5>Cấu hình: '.$row['display'].'</h5></td>
  </tr>
</table>';

}
?>
  </body>
</html>
  





