<?php
class Event {
	
	private $connection;
	
	function __construct($mysqli){
		
		$this->connection = $mysqli;
		
	}
	
		function saveEvent($event, $date, $location, $info) {
			
			$stmt = $this->connection->prepare("INSERT INTO s_event (event, date, location, info) VALUE (?, ?, ?, ?)");
			echo $this->connection->error;
			
			$stmt->bind_param("ssss", $event, $date, $location, $info);
			
			if ($stmt->execute() ){
				echo "õnnestus";
			} else {
				echo "ERROR".$stmt->error;
			}
		}
}
?>	
	