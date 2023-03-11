Contents
LAB 1: A script to add product in database.	 --> index.php 
Lab 02: A script to display the product in webpage.	--> display.php 
LAB 03: A script to add the product in shopping cart.	--> cart.php 
LAB 04: A script to maintain Wishlist.	--> wishlist.php 
LAB 05: A script to check out the cart.	--> checkout.php 
LAB 06:  A script to integrate the payment API (Esewa).	--> esewa.php 
CSS file	
JavaScript	



<!-- Source code for database configuration
Config.db
<?php
$conn = mysqli_connect('localhost','root','','yoga') or die('connection failed');
?>
Source code for creating table product in database
create database jersey
CREATE TABLE `products` (
  `id` int(255) AUTO_INCREMENT NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `image` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; -->

LAB 1: A script to add product in database. --> index.php
SOURCE CODE
<?php
@include 'config.php';
if(isset($_POST['add_to_cart'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;
   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");
   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'product added to cart succesfully';
   }
}
if(isset($_POST['add_to_wishlist'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;
   $select_wishlist = mysqli_query($conn, "SELECT * FROM wishlist WHERE name = '$product_name'");
   if(mysqli_num_rows($select_wishlist) > 0){
      $message[] = 'product already added to wishlist';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `wishlist`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'product added to wishlist succesfully';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};
?>
<div class="container">
<section class="products">
   <h1 class="heading">latest products</h1>
   <div class="box-container">
      <?php
      $select_products = mysqli_query($conn, "SELECT * FROM `products`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="post">
         <div class="box">
            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
            <input type="submit" class="btn" value="add to wishlist" name="add_to_wishlist">
         </div>
      </form>
      <?php
         };
      };
      ?>
   </div>
</section>
</div>
<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>



OUTPUT



Lab 02: A script to display the product in webpage.  --> display.php
SOURCE CODE:
<?php
@include 'config.php';
if(isset($_POST['add_to_cart'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;
   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");
   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'product added to cart succesfully';
   }
}
if(isset($_POST['add_to_wishlist'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;
   $select_wishlist = mysqli_query($conn, "SELECT * FROM wishlist WHERE name = '$product_name'");
   if(mysqli_num_rows($select_wishlist) > 0){
      $message[] = 'product already added to wishlist';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `wishlist`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'product added to wishlist succesfully';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};
?>
<div class="container">
<section class="products">
   <h1 class="heading">latest products</h1>
   <div class="box-container">
      <?php
      $select_products = mysqli_query($conn, "SELECT * FROM `products`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="post">
         <div class="box">
            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">Rs.<?php echo $fetch_product['price']; ?>/-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
            <input type="submit" class="btn" value="add to wishlist" name="add_to_wishlist">
         </div>
      </form>
      <?php
         };
      };
      ?>
   </div>
</section>
</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>
Source code for database configuration
Config.db
<?php
$conn = mysqli_connect('localhost','root','','jersey') or die('connection failed');
?>
OUTPUT


LAB 03: A script to add the product in shopping cart. --> cart.php
SOURCE CODE:
<?php
include 'setting.php';
@include 'config.php';
if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
      header('location:cart.php');
   };
};
if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:cart.php');
};
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:cart.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
<section class="shopping-cart">
   <h1 class="heading">shopping cart</h1>
   <table>
      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>total price</th>
         <th>action</th>
      </thead>
      <tbody>
         <?php 
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>Rs.<?php echo number_format($fetch_cart['price']); ?>/-</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                  <input type="submit" value="update" name="update_update_btn">
               </form>   
            </td>
            <td>$<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
            <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
         </tr>
         <?php
           $grand_total += $sub_total;  
            };
         };
         ?>
         <tr class="table-bottom">
            <td><a href="products.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
            <td colspan="3">grand total</td>
            <td>$<?php echo $grand_total; ?>/-</td>
            <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
         </tr>
      </tbody>
   </table>
   <div class="checkout-btn">
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a>
   </div>
</section>
</div>
<script src="js/script.js"></script>
</body>
</html>
Source code for connecting database (config.php):
<?php
$conn = mysqli_connect('localhost','root','','jersey') or die('connection failed');
?>
Source code for creating cart table in database
CREATE TABLE `cart` (
  `id` int(11) primary key AUTO_INCREMENT NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `image` varchar(2000) DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
OUTPUT:




LAB 04: A script to maintain Wishlist.
SOURCE CODE:
<?php
@include 'config.php';
if(isset($_POST['add_to_cart'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");
    if(mysqli_num_rows($select_cart) > 0){
          $message[] = 'product already added to cart';
       }else{
          $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
          $message[] = 'product added to cart succesfully';
       }
    }
   if(isset($_POST['add_to_wishlist'])){
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image = $_POST['product_image'];
      $product_quantity = 1;
      $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name'");
      if(mysqli_num_rows($select_wishlist) > 0){
         $message[] = 'product already added to wishlist';
      }else{
         $insert_product = mysqli_query($conn, "INSERT INTO `wishlist`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
         $message[] = 'product added to wishlist succesfully';
      }
   }
   if(isset($_GET['remove'])){
      $remove_id = $_GET['remove'];
      mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$remove_id'");
      header('location:wishlist.php');
   };
   if(isset($_GET['delete_all'])){
      mysqli_query($conn, "DELETE FROM `wishlist`");
      header('location:wishlist.php');
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>wishlist</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
?>
<div class="container">
<section class="products">
   <h1 class="heading">wishlist</h1>
   <div class="box-container">
      <?php
      $select_products = mysqli_query($conn, "SELECT * FROM `wishlist`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="post">
         <div class="box">
            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">Rs.<?php echo $fetch_product['price']; ?></div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
            <td><a href="wishlist.php?remove=<?php echo $fetch_product['id']; ?>" onclick="return confirm('remove item from cart?')" class="btn">remove</a></td>
         </div>
      </form>
      <?php
         };
      };
      ?>
   </div>
</section>

</div>
<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>
Source code for connecting database (config.php):
<?php
$conn = mysqli_connect('localhost','root','','jersey') or die('connection failed');
?>
Source code for creating cart table in database
CREATE TABLE `wishlist` (
  `id` int(11) primary key AUTO_INCREMENT NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `image` varchar(2000) DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
OUTPUT:



LAB 05: A script to check out the cart.
SOURCE CODE:
<?php
@include 'config.php';
if(isset($_POST['order_btn'])){
   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $house_no = $_POST['house_no'];
   $city = $_POST['city'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];
   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = number_format($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
      };
   };
   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(name, number, email, method, house_no, city, country, pin_code, total_products, total_price) VALUES('$name','$number','$email','$method','$house_no','$city','$country','$pin_code','$total_product','$price_total')") or die('query failed');
   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> total : $".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>".$name."</span> </p>
            <p> your number : <span>".$number."</span> </p>
            <p> your email : <span>".$email."</span> </p>
            <p> your address : <span>".$house_no.", ".$city.", ".$country." - ".$pin_code."</span> </p>
            <p> your payment mode : <span>".$method."</span> </p>
         </div>
         <a href='pay.php' class='btn'>Pay</a>
            <a href='products.php' class='btn'>continue shopping</a>
         </div>
      </div>
      ";
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
<section class="checkout-form">
   <h1 class="heading">complete your order</h1>
   <form action="" method="post">
   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : $<?= $grand_total; ?>/- </span>
   </div>
      <div class="flex">
         <div class="inputBox">
            <span>your name</span>
            <input type="text" placeholder="Name" name="name" required>
         </div>
         <div class="inputBox">
            <span>your number</span>
            <input type="number" placeholder="Phone Number" name="number" required>
         </div>
         <div class="inputBox">
            <span>your email</span>
            <input type="email" placeholder="Email" name="email" required>
         </div>
         <div class="inputBox">
            <span>payment method</span>
            <select name="method">
               <option value="cash on delivery" selected>cash on devlivery</option>
               <option value="credit cart">credit cart</option>
               <option value="esewa">esewa</option>
            </select>
         </div>
         <div class="inputBox">
            <span>House Number</span>
            <input type="text" placeholder="" name="house_no" required>
         </div>
         <div class="inputBox">
            <span>City</span>
            <input type="text" placeholder="" name="city" required>
         </div>
         <div class="inputBox">
            <span>country</span>
            <input type="text" placeholder="" name="country" required>
         </div>
         <div class="inputBox">
            <span>pin code</span>
            <input type="text" placeholder="" name="pin_code" required>
         </div>
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>
</section>
</div>
<!-- custom js file link  -->
<script src="js/script.js"></script> 
</body>
</html>
Source code for connecting database (config.php):
<?php
$conn = mysqli_connect('localhost','root','','jersey') or die('connection failed');
?>
Source code for table order in database:
CREATE TABLE `order` (`id` int(11) NOT NULL,`name` varchar(255) NOT NULL, `number` varchar(10) NOT NULL,`email` varchar(255) NOT NULL, `method` varchar(255) NOT NULL, `house_no` varchar(255) NOT NULL,`street` varchar(100) NOT NULL,`city` varchar(100) NOT NULL,`state` varchar(100) NOT NULL,
 `country` varchar(100) NOT NULL,`pin_code` int(100) NOT NULL,`total_products` varchar(255) NOT NULL, `total_price` varchar(255) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



OUTPUT:




LAB 06:  A script to integrate the payment API (Esewa).
SOURCE CODE:
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
@include 'config.php';?>
<?php
@include 'setting.php';?>
<div class="container">
<section class="checkout-form">
   <h1 class="heading">complete your payment</h1>
   <form action="" method="post">
   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : Rs.<?= $grand_total; ?>/- </span>
   </div>
   </form>
<!DOCTYPE html>
<html>
<head>
	<title>Checkout Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
<div class="col-md-6">
<h3><centre>Pay With<centre></h3>
<ul class="list-group">
<li class="list-group-item">
<form action="<?php echo $epay_url?>" method="POST">
<input value="<?php echo $total;?>" name="tAmt" type="hidden">
<input value="<?php echo $total;?>" name="amt" type="hidden">
<input value="0" name="txAmt" type="hidden">
<input value="0" name="psc" type="hidden">
<input value="0" name="pdc" type="hidden">
<input value=<?php echo $merchant_code?> name="scd" type="hidden">
<input value="<?php echo $pid?>" name="pid" type="hidden">
<input value="<?php echo $successurl?>" type="hidden" name="su">
<input value="<?php echo $failedurl?>" type="hidden" name="fu">
<input type="image" src="images/esewa.png">
<body>
    </form>
</body>
</ul>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
</section>
</div>
<script src="js/script.js"></script>
</body>
</html>


Source Code for Esewa Configuration (setting.php)
<?php
$epay_url="https://uat.esewa.com.np/epay/main";
$pid="jerseystore1000009";
$failedurl="http://localhost/shopping cart/esewa_payment_failed.php?q=fu";
$successurl="http://localhost/shopping cart/esewa_payment_success.php?q=su";
$merchant_code="epay_payment";
$fraudcheck_url="https://uat.esewa.com.np/epay/transrec";
?>
Source Code for Esewa Payment Success(esewa_payemnt_sucess.php)
<?php 
include 'setting.php';
echo "<h1> Payment Success. Thank you for choosing us.";
$oid=$_GET['oid'];
$amt=$_GET['amt'];
$ref=$_GET['refId'];
echo "<br>";
echo "Order ID: ".$oid."<br>";
echo "Amount:".$amt."<br>";
echo "Reference:".$ref."<br>";
?>
Source Code for Esewa Payment Failed(esewa_payemnt_failed.php)
<?php
echo "<h1> Payment failed";
?>
<a href="pay.php"> <br>Back to Homepage</a>

