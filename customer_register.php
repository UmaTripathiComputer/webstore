<!DOCTYPE html>
<?php
session_start();
include 'includes/db.connection.inc.php';
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
            <?PHP cart(); ?>
              <div id="shopping_cart">
                  <span style="float:right; font-size:18px; padding:5px; color:white; line-height:40px;">
                      Welcome Guest!
                      <b style="color:yellow; ">Shopping cart - </b>Total Items: <?php total_items();?>   ||   Total price: <span>&#8377;</span> <?php total_price();?>
                      <a href="cart.php" style="color:yellow">Go to cart</a>
                  </span>
              </div>

              <form action="customer_register.php" method="post" enctype="multipart/form-data">
                <table align="center" width="750">
                    <tr align="center">
                        <td colspan="20"><h2>Create an account</h2></td>
                    </tr>

                    <tr>
                        <td align="right">Customer Name:</td>
                        <td><input type="text" name="c_name" required/></td>
                    </tr>

                    <tr>
                        <td align="right">Customer Email:</td>
                        <td><input type="text" name="c_email" required/></td>
                    </tr>

                    <tr>
                        <td align="right">Customer password:</td>
                        <td><input type="password" name="c_pass" required/></td>
                    </tr>

                    <tr>
                        <td align="right">Customer image:</td>
                        <td><input type="file" name="c_image" required/></td>
                    </tr>

                    <tr>
                        <td align="right">Customer country:</td>
                        <td>
                          <select name="c_country">
                            <option>Select a country</option>
                            <option value="India">India</option>
                            <option value="China">China</option>
                            <option value="United states">United states</option>
                            <option value="United Kindgdom">United Kindgdom</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Russia">Russia</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                          </select>
                        </td>
                    </tr>

                    <tr>
                      <td align="right">Customer city:</td>
                      <td><input type="text" name="c_city" required/></td>
                    </tr>

                    <tr>
                      <td align="right">Customer contact:</td>
                      <td><input type="text" name="c_contact" length=10 required/></td>
                    </tr>

                    <tr>
                      <td align="right">Customer address:</td>
                      <td><textarea cols="20" rows="5" name="c_address" required></textarea></td>
                    </tr>

                    <tr align="center">
                      <td colspan="4"><input type="submit" name="register" value="Create account"/></td>
                    </tr>

                </table>
              </form>
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

<?php
if(isset($_POST['register'])){
  $ip=getIp();
  $c_ip=$ip;
  $c_name=$_POST['c_name'];
  $c_email=$_POST['c_email'];
  $c_password=$_POST['c_pass'];
  $c_country=$_POST['c_country'];
  $c_city=$_POST['c_city'];
  $c_contact=$_POST['c_contact'];
  $c_address=$_POST['c_address'];
  $c_image=$_FILES['c_image']['name'];
  $c_image_temp=$_FILES['c_image']['tmp_name'];

  $exist_query="select * from customers where customer_email='$c_email'";
  $run_exist=mysqli_query($GLOBALS['conn'],$exist_query);
  $check_exist=mysqli_num_rows($run_exist);

  if($check_exist == 0){
    move_uploaded_file($c_image_temp,"customer/customer_images/$c_image");
    $insert_c ="insert into customers (customer_ip,	customer_name,	customer_email,	customer_pass,	customer_country,	customer_city,	customer_contact,	customer_address,	customer_image) values ('$ip', '$c_name', '$c_email', '$c_password', '$c_country', '$c_city', '$c_contact', '$c_address', '$c_image')";

    $run_c=mysqli_query($GLOBALS['conn'],$insert_c);

    $sel_cart="select * from cart where ip_add = '$ip'";
    $run_cart=mysqli_query($GLOBALS['conn'],$sel_cart);
    $check_cart=mysqli_num_rows($run_cart);
        if($check_cart==0){
              $_SESSION['customer_email']=$c_email;
              echo "<script>alert('Account has been registered successfully. Thanks!')</script>";
              echo "<script>window.open('customer/my_account.php','_self')</script>";
        }else{
              $_SESSION['customer_email']=$c_email;
              echo "<script>alert('You are successfully registered. Thanks!')</script>";
              echo "<script>window.open(checkout.php,'_self')</script>";
        }
    }
    else{
        echo "<script>alert('This email is already registered with us. Try again')</script>";
        //echo "<script>window.open(checkout.php,'_self')</script>";
        exit();
  }

}
?>
