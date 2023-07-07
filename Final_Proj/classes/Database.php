<?php

/**
 * 
 */
class Database
{
	
	private $conn;
	public function connect(){
		$this->con = new Mysqli("localhost", "root", "", "Final_Project");
		return $this->con;
	}
}

?>