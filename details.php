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
              <li><a href="index.php">HOME</a></li>
              <li><a href="#">ALL PRODUCTS</a></li>
              <li><a href="#">MY ACCOUNT</a></li>
              <li><a href="#">SIGN UP</a></li>
              <li><a href="#">SHOPPING CART</a></li>
              <li><a href="#">CONTACT US</a></li>
          </ul>
          <div id="form"></div>
              <form method="post" action="result.php" enctype="multipart/form-data">
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
                      <b style="color:yellow; ">Shopping cart - </b>Total Items: <?php total_items();?>   ||   Total price: <span>&#8377;</span> <?php total_price();?>
                      <a href="cart.php" style="color:yellow">Go to cart</a>
                  </span>
              </div>
              <div id="products_box">
                    <?php
                    if(isset($_GET['pro_id'])){
                    $product_id = $_GET['pro_id'];
                    $get_pro="select * from products where product_id = '$product_id'";
                    $run_pro=mysqli_query($GLOBALS['conn'],$get_pro);
                    while($row_pro=mysqli_fetch_array($run_pro)){
                      $pro_id=$row_pro['product_id'];
                      $pro_title=$row_pro['product_title'];
                      $pro_images=$row_pro['product_image'];
                      $pro_price=$row_pro['product_price'];
                      $pro_desc=$row_pro['product_desc'];

                      echo "
                        <div id='single_product'>
                            <h3>$pro_title</h3>
                            <img src='admin_area/product_images/$pro_images' width='400' height='400'/>
                            <p><b>Price: <span>&#8377;</span> $pro_price</b></p>
                            <p>$pro_desc</p>
                            <a href='index.php?pro_id=$pro_id' style='float:left'>Go Back</a>
                            <a href='insert_product.php?pro_id=$pro_id'><button style='float:right'>Add to cart</button></a>
                        </div>
                      ";
                      }
                      }
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
