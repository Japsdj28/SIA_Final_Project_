<?php session_start(); ?>
<?php include_once("./templates_admin/top.php"); ?>
<?php include_once("./templates_admin/navbar.php"); ?>

    <?php include "./templates_admin/sidebar.php"; ?>

    <?php

@include 'db_conn.php';

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_quantity = $_POST['product_quantity'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_image/'.$product_image;
   $product_keywords = $_POST['product_keywords'];

   if(empty($product_name) || empty($product_price) || empty($product_image) || empty($product_quantity) || empty($product_image)){
      $message[] = 'please fill out all fields';
   }else{
      $insert = "INSERT INTO products(product_name, product_price, product_image, product_quantity, product_keywords) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity', '$product_keywords')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM products WHERE product_id = $id");
   header('location:products.php');
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css_admin/styles.css">
</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
   
<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new product</h3>
         <input type="text" placeholder="enter product name" name="product_name" class="box">
         <input type="number" placeholder="enter product price" name="product_price" class="box">
         <input type="number" placeholder="enter product quantity" name="product_quantity" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="text" placeholder="enter product keyword" name="product_keywords" class="box">
         <input type="submit" class="btn" name="add_product" value="add product">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM products");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>product image</th>
            <th>product name</th>
            <th>product price</th>
            <th>product quantity</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="uploaded_image/<?php echo $row['product_image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['product_name']; ?></td>
            <td>Php <?php echo $row['product_price']; ?></td>
            <td><?php echo $row['product_quantity']; ?></td>
            <td>
               <a href="product_update.php?edit=<?php echo $row['product_id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
               <a href="products.php?delete=<?php echo $row['product_id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>


</body>
</html>


<?php include_once("./templates_admin/footer.php"); ?>



<script type="text/javascript" src="./js/products.js"></script>
