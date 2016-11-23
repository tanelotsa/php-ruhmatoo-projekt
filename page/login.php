<?php

require("../functions.php");

require("../class/Helper.class.php");
$Helper = new Helper($mysqli);

require("../class/User.class.php");
$User = new User($mysqli);

if (isset($_SESSION["userId"])) {
    header("Location: data.php");
    exit();
}

$signupEmailError = "";
$signupEmail = "";
$loginEmail = "";
$loginEmailError = "";
$loginPasswordError = "";
$signupPasswordError = "";
$birthdateError = "";
$genderError = "";
$signupNameError = "";
$signupLocationError = "";

if (isset ($_POST["loginEmail"])) {


    if(empty($_POST["loginEmail"])) {

        $loginEmailError = "Sisesta E-Post !";

    } else {
        $loginEmail = $_POST["loginEmail"];
    }

}


if (isset ($_POST["loginPassword"])) {


    if(empty($_POST["loginPassword"])) {

        $loginPasswordError = "Sisesta Parool !";

    }

}


//kas keegi vajutas nuppu

if (isset ($_POST["signupEmail"])) {

    //on olemas
    //kas email on olemas
    if(empty($_POST["signupEmail"])) {

        //on tühi
        $signupEmailError = "Väli on kohustuslik!";

    } else {
        $signupEmail = $_POST["signupEmail"];
    }

}

//kas epost on tühi



if (isset ($_POST["signupPassword"])) {

    if(empty($_POST["signupPassword"])) {

        $signupPasswordError = "Väli on kohustuslik!";

    } else {

        if (strlen($_POST["signupPassword"]) < 8 ) {

            $signupPasswordError = "Vähemalt kaheksa märki !";
        }

    }

}

if (isset ($_POST["birthdate"])) {


    if(empty($_POST["birthdate"])) {

        //on tühi
        $birthdateError = "Väli on kohustuslik!";

    }

}

if (isset ($_POST["signupName"])) {


    if(empty($_POST["signupName"])) {

        //on tühi
        $signupNameError = "Väli on kohustuslik!";

    }

}

if (isset ($_POST["signupLocation"])) {


    if(empty($_POST["signupLocation"])) {

        //on tühi
        $signupLocationError = "Väli on kohustuslik!";

    }

}



if (isset ($_POST["gender"])) {


    if(empty($_POST["gender"])) {

        $genderError = "Väli on kohustuslik!";

    }

}

$gender = "Mees";

if (isset ($_POST["gender"])) {
    if (empty ($_POST["gender"])) {
        $genderError = "* Väli on kohustuslik!";
    } else {
        $gender = $_POST["gender"];
    }

}

if ( $signupEmailError == "" &&
    $signupPasswordError == "" &&
    $birthdateError == "" &&
    $genderError == "" &&
    $signupNameError == "" &&
    $signupLocationError == "" &&

    isset($_POST["signupEmail"]) &&
    isset($_POST["signupPassword"]) &&
    isset($_POST["birthdate"]) &&
    isset($_POST["gender"]) &&
    isset($_POST["signupName"]) &&
    isset($_POST["signupLocation"])

)  {

    //kõik olemas, vigu polnud
    //echo "SALVESTAN...<br>";
    //echo "email ".$signupEmail."<br>";
    //echo "parool ".$_POST["signupPassword"]."<br>";
    //echo "nimi ".$_POST["signupName"]."<br>";
    //echo "elukoht ".$_POST["signupLocation"]."<br>";
    //echo "sünnikuupäev ".$_POST["birthdate"]."<br>";
    //echo "sugu " .$_POST["gender"]. "<br>";


    $password = hash("sha512",$_POST["signupPassword"]);

    //echo $password ;

    $User->signup($Helper->cleanInput($signupEmail), $password);


    }



$notice = "";
//kas kasutaja tahab sisse logida
if ( isset($_POST["loginEmail"]) &&
    isset($_POST["loginPassword"]) &&
    !empty($_POST["loginEmail"]) &&
    !empty($_POST["loginPassword"])

    ) {
    $notice = $User->login($Helper->cleanInput($_POST["loginEmail"]), $Helper->cleanInput($_POST["loginPassword"]));

    }




?>




<?php require("../header.php"); ?>

    <div class="container">
        <div class="row">

                <img src="https://racycles.azureedge.net/catalog/cervelo-triathlon-pic.jpg" class="img-responsive" alt="Responsive image">

        </div>
    </div>

    <div class="container">

        <div class="row">

            <div class="col-sm-4 col-md-3">

                <h2>Logi Sisse</h2>
                <p> <?=$notice;?> </p>
                <form method="POST">

                    <label>E-Post:</label>


                    <div class="form-group">
                        <input class="form-control" name="loginEmail" type = "email" value="<?=$loginEmail;?>"> <?php echo $loginEmailError ; ?>
                    </div>


                    <label>Parool:</label>


                    <div class="form-group">
                        <input class="form-control" name="loginPassword" type = "password" > <?php echo $loginPasswordError ; ?>
                    </div>


                    <input class="btn btn-success btn-md hidden-xs" type = "submit" value = "LOGI SISSE" >
                    <input class="btn btn-success btn-sm btn-block visible-xs-block" type = "submit" value = "LOGI SISSE" >

                </form>
            </div>

            <div class="col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3">
                <h2>Liitu</h2>
            </div>

            <div class="col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3">
                <form method="POST">

                    <label>E-Post:</label>

                    <div class="form-group">
                        <input class="form-control" name="signupEmail" type = "email" value="<?=$signupEmail;?>"> <?php echo $signupEmailError ; ?>
                    </div>


                    <label>Parool:</label>


                    <div class="form-group">
                        <input class="form-control" name="signupPassword" type = "password" > <?php echo $signupPasswordError; ?>
                    </div>


                    <label>Nimi:</label>

                    <div class="form-group">
                        <input class="form-control" name="signupName" type = "text" > <?php echo $signupNameError; ?>
                    </div>
                    <input class="btn btn-primary btn-md hidden-xs" type = "submit" value = "LOO KASUTAJA" >
                    <input class="btn btn-primary btn-sm btn-block visible-xs-block" type = "submit" value = "LOO KASUTAJA" >
					
            </div>
            <div class="col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-0">

                        <label>Elukoht:</label>

                        <div class="form-group">
                            <input class="form-control" name="signupLocation" type = "text" > <?php echo $signupLocationError; ?>
                        </div>


                        <label>Sünnikuupäev:</label>


                        <div class="form-group">
                            <input class="form-control" name="birthdate" type = "date" > <?php echo $birthdateError; ?>
                        </div>


                        <label>Sugu:</label>

                        <div class="dropdown">

                            <select class="form-control" name="gender">

                                <option value="Mees">Mees</option>
                                <option value="Naine">Naine</option>
                        </div>



            </div>


        </div>

<?php require("../footer.php"); ?>