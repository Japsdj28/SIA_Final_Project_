<?php 

if(isset($_POST['fname']) && 
   isset($_POST['eaddress']) && 
   isset($_POST['pass'])){

    include "../db_conn.php";

    $fname = $_POST['fname'];
    $eaddress = $_POST['eaddress'];
    $password = $_POST['pass'];

    $data = "fname=".$fname."&eaddress=".$eaddress;
    
    if (empty($fname)) {
    	$em = "Full name is required";
    	header("Location: ../index.php?error=$em&$data");
	    exit;
    }else if(empty($eaddress)){
    	$em = "Email Address is required";
    	header("Location: ../index.php?error=$em&$data");
	    exit;
    }else if(empty($password)){
    	$em = "Password is required";
    	header("Location: ../index.php?error=$em&$data");
	    exit;
    }else {

    	// hashing the password
    	$password = password_hash($password, PASSWORD_DEFAULT);

    	$sql = "INSERT INTO users(fname, emailaddress, password) 
    	        VALUES(?,?,?)";
    	$stmt = $conn->prepare($sql);
    	$stmt->execute([$fname, $eaddress, $password]);

    	header("Location: ../index.php?success=Your account has been created successfully");
	    exit;
    }


}else {
	header("Location: ../index.php?error=error");
	exit;
}
