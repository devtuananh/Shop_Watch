<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="lib/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/css/hide.css">
    <title>Cửa hàng đồng hồ SHOP WATCH</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light" >
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php"><h5>Trang chủ</h5> <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="category" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><h5>Xem theo hãng</h5></a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php
              // Tải file sql lên
              require_once("database/connect.php");
              // Lấy danh sách hãng
              $sql_query = mysqli_query($con,"SELECT * FROM category");
              while($row=mysqli_fetch_array($sql_query)){
              	echo '<a class="dropdown-item" href="User\view_product.php?cate_id='.$row['category_id'].'"><h5>'.$row['category_name'].'</h5></a>';
              }
              ?>
            </div>
          </li>

            <?php 
            session_start();

            if ( !$_SESSION['user_id'])
            { 
                echo "   
                 <li class='nav-item'><a class='nav-link' href='Account/login.php'><h5>Đăng nhập</h5></a></li>
                 <?php echo '&nbsp &nbsp &nbsp';?>
                 <li class='nav-item'><a class='nav-link' href='Account/register.php'><h5>Đăng ký</h5></a></li>
                 <li class='nav-item'><h5><p class='nav-link'>Bạn chưa đăng nhập!</h5></p></li>"; 
            }
            else
            {
                $user_id = intval($_SESSION['user_id']);
                $sql_query = mysqli_query($con,"SELECT * FROM members WHERE id='{$user_id}'");
                $member = mysqli_fetch_array( $sql_query ); 
                if ($member['admin']=="1"){  
                	echo "<br><li class='nav-item'>
                  <a class='nav-link' href='Admin/admin_page.php'><h5>Quản trị</h5></a>
                </li>";
                }
                echo "
                      <li class='nav-item'><a class='nav-link' href='Account/suathongtin.php'><h5>Sửa thông tin</h5></a></li>   
                      <li class='nav-item'><a class='nav-link' href='Account/logout.php'><h5>Thoát ra</h5></a></li>
                "; 
            } 
        ?>
    </ul>

      <form action="User/find_product.php" class="form-inline my-2 my-lg-0">
      <input name="key" class="form-control mr-sm-2" type="search" placeholder="Giá hoặc tên sản phẩm" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" >Search</button>
      </form>
  </div>
</nav>
<div class="container">
  <div class="row">
    <div class="col-12">
    	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img height="250" width="300" class="d-block w-100" src="lib\slide2.PNG" alt="First slide">
    </div>
    <div class="carousel-item">
      <img height="250" width="300" class="d-block w-100" src="lib\slide4.PNG" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img height="250" width="300" class="d-block w-100" src="lib\slide5.PNG" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
      </div>
    </div>
   </div>	

  <div class="row">
    <div class="col">
    <H2>DANH SÁCH SẢN PHẨM</H2>		
              <?php 
         if (!isset($_GET['page'])) {
          $_GET['page'] = 1;
         }

         $vitri = ($_GET['page'] - 1) * 3;

         // Hien thi tat ca san pham

         $result  = "select * from product join category on product.category_id = category.category_id limit ".$vitri.",3";
         $query  = mysqli_query($con, $result);

          while ($row = mysqli_fetch_assoc($query)) {
          echo '
            <img height="200" width="230" src="Admin/Manage_Product/images/'.$row['image'].'"/><br>
            <a href="User/view_product_detail.php?product_id='.$row['product_id'].'"><h5>'.$row['product_name'].'</h5></a>
            <h5>Giá: '.$row['category_name'].'</h5>
            <h5>Giá: '.$row['price'].' đ</h5>
            <h5>Cấu hình: '.$row['display'].'</h5>
           ';
         }

         $re = "select * from product";
         $query =mysqli_query($con, $re); 
         $n = mysqli_num_rows($query);
         
         if($n % 3 == 0){
           $tong_so_trang = floor($n/3);
         }else $tong_so_trang = floor($n/3) + 1;

         if ($_GET['page'] > 1) { 
         	echo '&nbsp <a href="index.php?page='.($_GET['page']-1).'">Back</a>';
           }

         for ($i=1 ; $i<=$tong_so_trang ; $i++) {
          if ($i == $_GET['page']) {
               echo '&nbsp &nbsp'.$i.' ';
          } else {
              echo '&nbsp <a href="index.php?page='.$i.'">'.$i.'</a>';
           }

        }
        if ($_GET['page'] < $tong_so_trang) { 
        	echo '&nbsp <a href="index.php?page='.($_GET['page']+1).'">Next</a>';}
        ?>
    </div>
    <div class="col">
    	<H2>DANH SÁCH 10 SẢN PHẨM MỚI</H2>		
        <?php 

       $result3  = "select * from product join category on product.category_id = category.category_id order by date desc";
       $query3  = mysqli_query($con, $result3);
       while ($row3 = mysqli_fetch_assoc($query3)) {
       	  echo '
        <table>
        <tr>
          <img height="50" width="70" src="Admin/Manage_Product/images/'.$row3['image'].'"/>
        </tr>
        <tr>
          <a href="User/view_product_detail.php?product_id='.$row3['product_id'].'"><h5>'.$row3['product_name'].'</h5></a>
        </tr>

      </table>';
       }
      ?>
    </div>	
  </div>
</div>  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="lib/js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="lib/js/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="lib/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>

