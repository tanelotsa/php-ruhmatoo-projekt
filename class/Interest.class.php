<?php
class Interest {
	
	private $connection;
	

	function __construct($mysqli){
		
		$this->connection = $mysqli;
		
	}
	
	