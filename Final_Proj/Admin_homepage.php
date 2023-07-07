<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {

}
	include "./templates_admin/top.php"; 

	?>
	 
	<?php include "./templates_admin/navbar.php"; ?>
	
	<div class="container-fluid">
	  <div class="row">
		
		<?php include "./templates_admin/sidebar.php"; ?>
	
		  <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->
	
		  <h2><center>Admin Details</center></h2>
		  <div class="table-responsive">
			<table class="table table-striped table-sm">
			  <thead>
				<tr>
				  <th>#</th>
				  <th>Name</th>
				  <th>Email</th>
				</tr>
			  </thead>
			  <tbody id="admin_list">
				<tr>
				  <td>1</td>
				  <td>Kenneth Guevara</td>
				  <td>kennethguevara01@gmail.com</td>
				</tr>
			  </tbody>
			</table>
		  </div>
		</main>
	  </div>
	</div>
	
	<?php include "./templates_admin/footer.php"; ?>
	
	<script type="text/javascript" src="./js_admin/admin.js"></script>
