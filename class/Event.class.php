<?php
class Event {
	
	private $connection;
	
	function __construct($mysqli){
		
		$this->connection = $mysqli;
		
	}
	
		function saveEvent($event, $date, $time, $location, $info) {
			
			$stmt = $this->connection->prepare("INSERT INTO s_event (event, date, time, location, info) VALUE (?, ?, ?, ?, ?)");
			echo $this->connection->error;
			
			$stmt->bind_param("sssss", $event, $date, $time, $location, $info);
			
			if ($stmt->execute() ){
				echo "�nnestus";
			} else {
				echo "ERROR".$stmt->error;
			}
		}
}
?>	
	