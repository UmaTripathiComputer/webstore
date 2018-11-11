<!DOCTYPE html>
<?php
include 'admin_area/includes/db.connection.inc.php';
include 'functions/function.php';
?>

<html>
<head>
  <title>My Online shop</title>

  <link rel="stylesheet" href="styles/style.css" media:"all"/>
</head>
<body>
  <!-- Main wrapper starts here-->
  <div class="main_wrapper">

      <!--Header starts here-->
      <div class="header_wrapper">

          <img id='logo' src="images/image1.jpeg">
          <img id='banner' src="images/image2.jpeg">

      </div>
      <!--Header ends here-->

      <!--Menu starts here-->
      <div class="menubar">
          <ul id="menu">
              <li><a href="index.php ">HOME</a></li>
              <li><a href="all_products.php">ALL PRODUCTS</a></li>
              <li><a href="customer/my_account.php">MY ACCOUNT</a></li>
              <li><a href="#">SIGN UP</a></li>
              <li><a href="cart.php">SHOPPING CART</a></li>
              <li><a href="#">CONTACT US</a></li>
          </ul>
          <div id="form"></div>
              <form method="post" action="results.php" enctype="multipart/form-data">
                  <input type="text" name="user_query" placeholder="Search a product" />
                  <input type="submit" name="search" value="Search" />
              </form>

          </div>
      <!--Menu ends here-->

      <!--content starts here -->
      <div class="content_wrapper">
          <div id="sidebar">

              <div id="sidebar_title">Categories</div>
                  <ul id="cats">
                    <?php getCategories();?>
                  </ul>

              <div id="sidebar_title">Brands</div>
                  <ul id="cats">
                      <?php getBrands();?>
                  </ul>

          </div>

          <div id="content_area">

              <div id="shopping_cart">
                  <span style="float:right; font-size:18px; padding:5px; color:white; line-height:40px;">
                      Welcome Guest!
                      <b style="color:yellow; ">Shopping cart - </b>Total Items: Total price:
                      <a href="cart.php" style="color:yellow">Go to cart</a>
                  </span>
              </div>
              <div id="products_box">
                  <?php

                      $run_pro=mysqli_query($GLOBALS['conn'],"select * from products");

                      while($row_pro=mysqli_fetch_array($run_pro)){
                        $pro_id=$row_pro['product_id'];
                        $pro_title=$row_pro['product_title'];
                        $pro_images=$row_pro['product_image'];
                        $pro_price=$row_pro['product_price'];

                        echo "
                        <div id='single_product'>
                            <h3>$pro_title</h3>
                            <img src='admin_area/product_images/$pro_images' width='180' height='180'/>
                            <p><b>Price: $ $pro_price</b></p>
                            <a href='details.php?pro_id=$pro_id' style='float:left'>Details</a>
                            <a href='insert_product.php?pro_id=$pro_id'><button style='float:right'>Add to cart</button></a>
                        </div>
                        ";
                        }

                          getCatPro();
                          getBrandPro();
                  ?>
              </div>
          </div>
      </div>
      <!--content ends here -->

      <div id="footer">
          <h2 style="text-align:center; padding-top:40px;">&copy; 2018 Made by Uma</h2>
      </div>

  </div>
  <!-- Main wrapper ends here-->

</body>
</html>
