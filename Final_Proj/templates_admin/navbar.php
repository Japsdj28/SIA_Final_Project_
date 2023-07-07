 <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Gizmos Gadget Shop</a>
  <input class="form-control form-control-dark w-100" type="text" placeholder="search" aria-label="search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
    	<?php
    		if (isset($_SESSION['id'])) {
    			?>
    				<a class="nav-link" href="login.php">Sign out</a>
    			<?php
    		}else{
    			$uriAr = explode("/", $_SERVER['REQUEST_URI']);
    			$page = end($uriAr);
    			if ($page === "signup.php") {
    				?>
	    				<a class="nav-link" href="signup.php">Register</a>
	    			<?php
    			}else{
    				?>
	    				<a class="nav-link" href="login.php">Login</a>
	    			<?php
    			}


    			
    		}

    	?>
      
    </li>
  </ul>
</nav>

