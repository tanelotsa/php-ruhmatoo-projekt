    <?php
    require("../functions.php");

    require("../class/Helper.class.php");
    $Helper = new Helper($mysqli);

	require("../class/Event.class.php");
	$Event = new Event($mysqli);

	$eventError = "";

	if (isset ($_POST["event"])) {
			if (empty ($_POST["event"])) {
				$eventError = "Sisesta treeningu liik!";
			} else {
				$event = $_POST["event"];
		}

	}

	$dateError = "";

	if (isset ($_POST["date"])) {
			if (empty ($_POST["date"])) {
				$dateError = "Sisesta kuupäev!";
			} else {
				$date = $_POST["date"];
		}

	}

	$timeError = "";
	if (isset ($_POST["time"])) {
		if (empty ($_POST["time"])) {
			$dateError = "Sisesta kellaaeg!";
		} else {
			$date = $_POST["time"];
		}

	}

	$locationError = "";

	if (isset ($_POST["location"])) {
			if (empty ($_POST["location"])) {
				$locationError = "*Sisesta asukoht!";
			} else {
				$location = $_POST["location"];
		}

	}



    if (!isset($_SESSION["userId"])) {
        header("Location: login.php");  //iga headeri järele tuleks lisada exit
        exit();
    }


    if (isset($_GET["logout"])) {

        session_destroy();

        header("Location: login.php");
        exit();
    }


	if ( isset($_POST["event"]) &&
	     isset($_POST["date"]) &&
		 isset($_POST["time"]) &&
		 isset($_POST["location"]) &&
		 !empty($_POST["event"]) &&
		 !empty($_POST["date"])&&
		 !empty($_POST["time"])&&
		 !empty($_POST["location"])
		 ) {
			 $Event->saveEvent($Helper->cleanInput($_POST["event"]), $Helper->cleanInput($_POST["date"]), $Helper->cleanInput($_POST["time"]), $Helper->cleanInput($_POST["location"]), $Helper->cleanInput($_POST["info"]));
       echo Õnnestus ;
			 header("Location: data.php");


			 }

    ?>

    <?php require("../header.php"); ?>
    <div class="container">
        <div class="row">


				<h3>
					Tere tulemast <?=$_SESSION["userName"];?>!
					<a href="?logout=1">Logi Välja</a>
				</h3>

				<h1>Loo uus treening</h1>

			<div class="col-sm-4 col-md-3">

				<form method="POST" >

				<div class="form-group">

					<label>treeningu liik</label><br>
					<input class="form-control" type="text" name="event" > <?php echo $eventError; ?>

				</div>

				<div class="form-group">

					<label>kuupäev</label><br>
					<input class="form-control" type="date" name="date"> <?php echo $dateError; ?>

				</div>

				<div class="form-group">

					<label>kellaaeg</label><br>
					<input class="form-control" type="time" name="time"> <?php echo $timeError; ?>
				</div>

				<div class="form-group">

					<label>asukoht</label><br>
					<input class="form-control" type="text" name="location"> <?php echo $locationError; ?>

					</div>

				<div class="form-group">

					<label>Lisainfo</label><br>
					<input class="form-control" type="text" name="info" >

				</div>

					<input class="btn btn-success btn-md hidden-xs" type = "submit" value = "Loo treening" >
					<input class="btn btn-success btn-sm btn-block visible-xs-block" type = "submit" value = "Loo treening" >

				</form>

			</div>


        </div>

    </div>
    <?php require("../footer.php"); ?>
