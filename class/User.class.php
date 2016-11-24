<?php
class User{

    private $connection;

    // käivitatakse siis kui on = new User(see jõuab siia)
    function __construct($mysqli){
        //this viitab sellele klassile ja selle klassi muutujale
        $this->connection = $mysqli;
    }

    function login ($email, $password) {

        $notice = "";

        $stmt = $this->connection->prepare("SELECT id, email, password, created, gender, birthdate, name, location FROM s_user_info WHERE email = ? ");
        echo $this->connection->error;

        //asendan ?

        $stmt->bind_param("s", $email);

        //rea kohta tulba väärtus
        $stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created, $gender, $birthdate, $name, $location);

        $stmt->execute();
        //ainult SELECT'i puhul
        if($stmt->fetch()) {
            //oli olemas, rida käes
            $hash = hash("sha512", $password);

            if ($hash == $passwordFromDb) {
                echo "Kasutaja $id logis sisse";

                $_SESSION ["userId"] = $id;
                $_SESSION ["userEmail"] = $emailFromDb;
                $_SESSION ["userName"] = $name;
                $_SESSION ["userGender"] = $gender;
                $_SESSION ["userLocation"] = $location;
                $_SESSION ["userBirthDate"] = $birthdate;

                header("Location: data.php");




            } else {
                $notice = "Parool vale !";
            }

        } else {
            //ei olnud ühtegi rida
            $notice = "Sellise e-mailiga ".$email." kasutajat ei ole olemas!";
        }

        return $notice;

    }

    function signup($email, $password) {

        //loon ühenduse

        $stmt = $this->connection->prepare("INSERT INTO s_user_info (email, password, gender, birthdate, name, location) VALUE(?,?,?,?,?,?)");
        echo $this->connection->error;
        //asendan küsimärgid
        //iga märgikohta tuleb lisada üks täht ehk mis tüüpi muutuja on
        //	s - string
        //	i - int,arv
        //  d - double
        $stmt->bind_param("ssssss", $email, $password, $_POST["gender"], $_POST["birthdate"],$_POST["signupName"],$_POST["signupLocation"]);


        //täida käsku
        if($stmt->execute() ) {
            //echo "Õnnestus!";
			
        } else{
            echo "ERROR".$stmterror;
        }

    }

}
?>