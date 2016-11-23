<?php
class Interest {
	
	private $connection;
	

	function __construct($mysqli){
		
		$this->connection = $mysqli;
		
	}
	
	function saveInterest($interest) {
		
        $stmt = $this->connection ->prepare("INSERT INTO s_interests (interest, userid) VALUE(?,?)");
		
        echo $this->connection->error;
        $stmt->bind_param("si", $interest, $_SESSION ["userId"]);
        if($stmt->execute() ) {
            echo "Õnnestus!","<br>";
        } else{
            echo "ERROR".$stmterror;
        }
    }

	    function getAllInterests () {
			
        $stmt = $this->connection->prepare("SELECT id, interest FROM s_interests Where userid = ? AND deleted IS NULL");
		
        $stmt->bind_param("i", $_SESSION ["userId"]);
        $stmt->bind_result($id, $interest);
        $stmt->execute ();
        $results = array();
        //tsükli sisu tehakse niimitu korda , mitu rida sql lausega tuleb
        while($stmt->fetch()) {
            $interests = new StdClass();
            $interests->id = $id;
            $interests->interest = $interest;

            //echo $color."<br>";
            array_push($results,$interests);
        }
        return $results;
    }	
	
	function deleteInterest($id){

        $stmt = $this->connection ->prepare("UPDATE s_interests SET deleted=NOW() WHERE id=? AND deleted IS NULL");
        $stmt->bind_param("i",$id);
        // kas õnnestus salvestada
        if($stmt->execute()){
            // õnnestus
            echo "salvestus õnnestus!";
        }
        $stmt->close();
    }
	
	
}