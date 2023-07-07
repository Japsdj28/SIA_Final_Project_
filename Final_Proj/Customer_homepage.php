<?php

session_start();
include "db_conn.php";
if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Ecommerce</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script>
		if (performance.navigation.type === 1) {
			window.location.href = "logout.php";
		}
	    </script>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
		<style>
			@media screen and (max-width:480px){
				#search{width:80%;}
				#search_btn{width:30%;float:right;margin-top:-32px;margin-right:10px;}
			}
		</style>
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">	
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
						<span class="sr-only"> navigation toggle</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="Customer_homepage.php" class="navbar-brand">TechNo Shop</a>
				</div>
				<div class="collapse navbar-collapse" id="collapse">
					<ul class="nav navbar-nav">
						<li><a href="Customer_homepage.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
						<li><a href="Customer_homepage.php"><span class="glyphicon glyphicon-modal-window"></span> Product</a></li>
						<li>
							<div class="search">
								<form method="post" action="">
									<input type="text" name="search_keyword" placeholder="Search for products...">
									<button type="submit" name="search_button">Search</button>
								</form>
							</div>
						</li>
					</ul>
</ul>

?>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" id="cart_container" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge">0</span></a>
					<div class="dropdown-menu" style="width:400px;">
						<div class="panel panel-success">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-3 col-xs-3">Sl.No</div>
									<div class="col-md-3 col-xs-3">Product Image</div>
									<div class="col-md-3 col-xs-3">Product Name</div>
									<div class="col-md-3 col-xs-3">Price in <?php echo CURRENCY; ?></div>
								</div>
							</div>
							<div class="panel-body">
								<div id="cart_product">
								<!--<div class="row">
									<div class="col-md-3">Sl.No</div>
									<div class="col-md-3">Product Image</div>
									<div class="col-md-3">Product Name</div>
									<div class="col-md-3">Price in $.</div>
								</div>-->
								</div>
							</div>
							<div class="panel-footer"></div>
						</div>
					</div>
				</li>
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo "Hi, ".$_SESSION["fname"]; ?></a>
					<ul class="dropdown-menu">
						<li><a href="cart.php" style="text-decoration:none; color:black;"><span class="glyphicon glyphicon-shopping-cart"> Cart</a></li>
						<li class="divider"></li>
						<li><a href="customer_order.php" style="text-decoration:none; color:black;">Orders</a></li>
						<li class="divider"></li>
						
						<li><a href="logout.php" style="text-decoration:none; color:black;">Logout</a></li>
					</ul>
				</li>
				
			</ul>
		</div>
	</div>
	</div>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2">
				<div id="get_category">
				</div>
				<!--<div class="nav nav-pills nav-stacked">
					<li class="active"><a href="#"><h4>Categories</h4></a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
				</div> -->
				<div id="get_brand">
				</div>
				<!--<div class="nav nav-pills nav-stacked">
					<li class="active"><a href="#"><h4>Brand</h4></a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
				</div> -->
			</div>
			<div class="col-md-8">	
				
				<div class="row">
					<div class="col-md-12 col-xs-12" id="product_msg">
					</div>
				</div>
				<?php
					if (isset($_POST["search_button"])) {
						$search_keyword = $_POST["search_keyword"];
						$sql = "SELECT * FROM products WHERE product_name LIKE '%$search_keyword%'";
						$run_query = mysqli_query($conn, $sql);

						if (mysqli_num_rows($run_query) > 0) {
							while ($row = mysqli_fetch_array($run_query)) {
								$pro_id = $row['product_id'];
								$pro_title = $row['product_name'];
								$pro_keyword = $row['product_keywords'];
								$pro_price = $row['product_price'];
								$pro_image = $row['product_image'];

								// Display the search results
								echo "
									<div class='col-md-4'>
										<div class='panel panel-info'>
											<div class='panel-heading'>$pro_title</div>
											<div class='panel-body'>
												<img src='uploaded_image/$pro_image' style='width:220px; height:250px;'/>
											</div>
											<div class='panel-heading'>Php$pro_price
												<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Add To Cart</button>
											</div>
										</div>
									</div>";
							}
						} else {
							echo "No products found.";
						}

						// Stop further execution to prevent displaying other sections
						exit();
					}
					?>
				<div class="panel panel-info" id="scroll">
					<div class="panel-heading">Products</div>
					<div class="panel-body">
						<div id="get_product">
							<!--Here we get product jquery Ajax Request-->
						</div>
						<!--<div class="col-md-4">
							<div class="panel panel-info">
								<div class="panel-heading">Samsung Galaxy</div>
								<div class="panel-body">
									<img src="product_images/images.JPG"/>
								</div>
								<div class="panel-heading">$.500.00
									<button style="float:right;" class="btn btn-danger btn-xs">AddToCart</button>
								</div>
							</div>
						</div> -->
						
					</div>
					<div class="panel-footer">&copy; <?php echo date("Y"); ?></div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<center>
					<ul class="pagination" id="pageno">
						<li><a href="#">1</a></li>
					</ul>
				</center>
			</div>
		</div>
	</div>
	
</body>
</html>
        <?php

} else {
    // Users who are not logged in are redirected to the login page
    header("Location: login.php");
    exit;
}
