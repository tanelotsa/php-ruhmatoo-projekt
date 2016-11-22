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


	function getAllEvents ($q) {



        if ($q != "") {
            //otsin
            echo "otsin: ".$q;
            $stmt = $this->connection->prepare("
              SELECT id, event, date, time, location, info FROM s_event WHERE deleted IS NULL AND ( event LIKE ? OR date LIKE ? OR time LIKE ? OR location LIKE ? OR info LIKE ?)
              ");
            $searchWord = "%".$q."%";
            $stmt->bind_param("sssss", $searchWord, $searchWord, $searchWord, $searchWord, $searchWord);
        } else {
            //ei otsi
            $stmt = $this->connection->prepare("SELECT id, event, date, time, location, info FROM s_event WHERE deleted IS NULL");
           
        }



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


	function getSingleEventData($edit_id){

		$stmt = $this->connection->prepare("SELECT event, date, time, location, info FROM s_event WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($event, $date, $time, $location, $info);
		$stmt->execute();
		//tekitan objekti
		$s = new Stdclass();
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$s->event = $event;
			$s->date = $date;
			$s->time = $time;
			$s->location = $location;
			$s->info = $info;
		}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
			header("Location: data.php");
			exit();
		}
		$stmt->close();
		return $s;
	}

	function updateEvent($id, $event, $date, $time, $location, $info){

		$stmt = $this->connection->prepare("UPDATE s_event SET event=?, date=?, time=?, location=?, info=? WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("sssssi",$event, $date, $time, $location, $info, $id);
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "salvestus õnnestus!";
		}
		$stmt->close();
	}

	function deleteEvent($id){

		$stmt = $this->connection ->prepare("UPDATE s_event SET deleted=NOW() WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("i",$id);
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "salvestus õnnestus!";
		}
		$stmt->close();
	}

}
?>	
	