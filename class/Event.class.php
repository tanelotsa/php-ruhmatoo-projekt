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


	function getAllEvents () {

		$stmt = $this->connection->prepare("SELECT id, event, date, time, location, info FROM s_event WHERE deleted IS NULL");
		//$stmt->bind_param("i", $_SESSION ["userId"]);
		$stmt->bind_result($id, $event, $date, $time, $location, $info);
		$stmt->execute ();
		$results = array();
		//tsükli sisu tehakse niimitu korda , mitu rida sql lausega tuleb
		while($stmt->fetch()) {
			$sport = new StdClass();
			$sport->id = $id;
			$sport->event = $event;
			$sport->date = $date;
			$sport->time = $time;
			$sport->location = $location;
			$sport->info = $info;
			//echo $color."<br>";
			array_push($results,$sport);
		}
		return $results;
	}

}
?>	
	