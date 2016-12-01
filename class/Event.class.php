<?php
class Event {

    private $connection;

    function __construct($mysqli){

        $this->connection = $mysqli;

    }

    function saveEvent($event, $date, $time, $location, $info, $places) {

        $stmt = $this->connection->prepare("INSERT INTO s_event (event, date, time, location, info, places, author) VALUE (?, ?, ?, ?, ?, ?, ?)");
        echo $this->connection->error;

        $stmt->bind_param("sssssii", $event, $date, $time, $location, $info, $places, $_SESSION ["userId"]);

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
              SELECT id, event, date, time, location, info, places FROM s_event WHERE deleted IS NULL AND ( event LIKE ? OR date LIKE ? OR time LIKE ? OR location LIKE ? OR info LIKE ? OR places LIKE ?)
              ");
            $searchWord = "%".$q."%";
            $stmt->bind_param("sssssi", $searchWord, $searchWord, $searchWord, $searchWord, $searchWord, $searchWord);
        } else {
            //ei otsi
            $stmt = $this->connection->prepare("SELECT id, event, date, time, location, info, places FROM s_event WHERE deleted IS NULL");

        }



        //$stmt->bind_param("i", $_SESSION ["userId"]);
        $stmt->bind_result($id, $event, $date, $time, $location, $info, $places);
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
            $sport->places = $places;
            //echo $color."<br>";
            array_push($results,$sport);
        }
        return $results;
    }


    function getSingleEventData($edit_id){

        $stmt = $this->connection->prepare("SELECT event, date, time, location, info, places FROM s_event WHERE id=? AND author =? AND deleted IS NULL");

        $stmt->bind_param("ii", $edit_id,$_SESSION ["userId"]);
        $stmt->bind_result($event, $date, $time, $location, $info, $places);
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
            $s->places = $places;
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

    function attendSingleEvent($edit_id){

        $stmt = $this->connection->prepare("SELECT event, date, time, location, info, places FROM s_event WHERE id=? AND deleted IS NULL");

        $stmt->bind_param("i", $edit_id);
        $stmt->bind_result($event, $date, $time, $location, $info, $places);
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
            $s->places = $places;
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

    function updateEvent($id, $event, $date, $time, $location, $info, $places){

        $stmt = $this->connection->prepare("UPDATE s_event SET event=?, date=?, time=?, location=?, info=?, places=? WHERE id=? AND deleted IS NULL");

        $stmt->bind_param("sssssii",$event, $date, $time, $location, $info, $places, $id);
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

    function attendEvent($eventid) {

        $stmt = $this->connection->prepare("INSERT INTO s_attend (user_id, event_id, attending) VALUE (?, ?, ?)");
        echo $this->connection->error;

        $attending = 1;

        $stmt->bind_param("iii", $_SESSION ["userId"], $eventid, $attending);

        if ($stmt->execute() ){
            echo "õnnestus";
        } else {
            echo "ERROR".$stmt->error;
        }
    }

    function editMyEvent(){

        $stmt = $this->connection->prepare("SELECT id, event, date, time, location, info, places FROM s_event WHERE author=? AND deleted IS NULL");

        $stmt->bind_param("i", $_SESSION ["userId"]);
        $stmt->bind_result($id, $event, $date, $time, $location, $info, $places);
        $stmt->execute ();
        $results = array();
        //tsükli sisu tehakse niimitu korda , mitu rida sql lausega tuleb
        while($stmt->fetch()) {
            $training = new StdClass();
            $training->id = $id;
            $training->event = $event;
            $training->date = $date;
            $training->time = $time;
            $training->location = $location;
            $training->info = $info;
            $training->places = $places;
            //echo $color."<br>";
            array_push($results,$training);
        }
        return $results;
    }

}
?>
