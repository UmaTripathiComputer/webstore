<!DOCTYPE html>
<?php
session_start();
include 'admin_area/includes/db.connection.inc.php';
include 'functions/function.php';
GLOBAL $cart_total;
GLOBAL $total;
$total=0;
GLOBAL $single_product_total_price;
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
            <?PHP cart(); ?>
              <div id="shopping_cart">
                  <span style="float:right; font-size:18px; padding:5px; color:white; line-height:40px;">
                    <?php
                      if(isset($_SESSION['customer_email'])){
                        echo "<b>Welcome ".$_SESSION['customer_email']."! ";
                      }else{
                        echo "<b>Welcome Guest! </b>";
                      }
                    ?>
                      <b style="color:yellow; ">Shopping cart - </b>Total Items: <?php total_items();?>   ||   Total price: <span>&#8377;</span>
                      <?php total_price();
                      if(!isset($_SESSION['customer_email'])){
                        echo "<a href='checkout.php' style='color:white'> Login</a>";
                      }else{
                        echo "<a href='logout.php' style='color:white'> Logout</a>";
                      }
                      ?>
                      <!--<a href="cart.php" style="color:yellow">Go to cart</a>-->
                  </span>
              </div>

              <?php getIp();?>
              <div id="products_box">
                <form action="" method="post" enctype="multipart/form-data">
                    <table align="center" width="700" bgcolor="skyblue" border="1px solid black">
                      <tr align="center">
                        <th>Remove     </th>
                        <th>Product(s) </th>
                        <th>Quantity   </th>
                        <th>Total Price</th>
                      </tr>
<?php
//to get the ip address
$ip=getIp();
$sel_price="select * from cart where ip_add='$ip'";
$run_price=mysqli_query($conn,$sel_price);
//fetching all products from my cart
while($p_price=mysqli_fetch_array($run_price)){
  $pro_id= $p_price['p_id'];
  $pro_price="select * from products where product_id='$pro_id'";
  $run_pro_price=mysqli_query($GLOBALS['conn'],$pro_price);
  //fetching details of each product
  while($pp_price=mysqli_fetch_array($run_pro_price)){
    $product_price = array($pp_price['product_price']);//added
    $product_title=$pp_price['product_title'];
    $product_image=$pp_price['product_image'];
    $single_price=$pp_price['product_price'];//added
    $values=array_sum($product_price);
    $total+=$values;
?>

                      <tr align="center">
                        <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"/></td>
                        <td><?php echo "<b>$product_title</b><br>"?>
                            <img src="admin_area/product_images/<?php echo $product_image?>"
                            border="20" height="100" width="100">
                        </td>
                        <td><input type='text' size="4" name='qty' value="<?php echo $_SESSION['qty'];?>"/></td>

                        <?php

                            if(isset($_POST['update_cart'])){
                        		    $qty=$_POST['qty'];
                                $update_qty="update cart set qty='$qty'";
                                $run_qty=mysqli_query($GLOBALS['conn'],$update_qty);
                                $_SESSION['qty']=$qty;
                                $total = $total*$qty;
                            }

                        ?>




                        <td><span>&#8377;</span>
                          <!-- <?php echo "<b>: $single_product_total_price</b>"?> removed -->
                          <!-- added--><?php echo "<b>: $single_price</b>"?>
                        </td>
                      </tr>

<?php
    }
  }
?>

                    <tr align="right">
                      <td colspan="5"><b>Cart total : </b></td>
                      <td><b><span>&#8377;</span><?php echo " ".$total?></b></td>

                    </tr>
                    <tr>
                      <?php if($total>0) {?>
                      <td colspan="2"><input type="submit" name="update_cart" value="Update cart"/></td>
                    <?php }else{ ?>
                      <td colspan="2"><input type="submit" name="continue" value="<?php echo "Your cart is empty! Pick something intresting.";?>"/></td>

                                <?php } ?>
                      <td colspan="2"><input type="submit" name="continue" value="Continue shopping"/></td>

                      <?php if($total>0) {?>
                      <td colspan="2">
                        <button><a href="checkout.php"  name="Checkout" style="text-decoration:none; color:black;">Check-out</a></button>
                      </td>
                    </tr>
                  <?php } ?>
                    </table>
                </form>

<?php
function updateCart(){
  $ip=getIp();

  if(isset($_POST['update_cart'])){
    foreach($_POST['remove'] as $remove_id){
      $delete_product= "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
      $run_delete=mysqli_query($GLOBALS['conn'],$delete_product);
      if($run_delete){
        echo "<script>window.open('cart.php','_self')</script>";
      }
    }
  }
  if(isset($_POST['continue'])){
    echo "<script>window.open('index.php','_self')</script>";
  }
}
echo @$up_cart=updateCart();
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
