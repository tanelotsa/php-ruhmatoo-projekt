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

			 header("Location: data.php");


			 }

			 // otsib
	if (isset($_GET["q"])) {
		
		$q = $_GET["q"];
	
	} else {
		//ei otsi
		$q = "";
	}
	
	
			 
	$sport = $Event->getAllEvents($q);

    ?>

    <?php require("../header.php"); ?>
	
    <div class="container" style="width:100%;background-color:#EBEBE6;">
        <div class="row">

			<div class="col-sm-4 col-md-4 col-md-offset-1">

				<h2>
					Tere tulemast <?=$_SESSION["userName"];?>!
				</h2>
			</div>


			<div class="col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-3">
				<h2>
					<a class='btn btn-default btn-md' href='training.php?id=".$s->id."'>Minu Treeningud</a>
					<a class='btn btn-default btn-md' href='user.php?id=".$s->id."'>Kasutaja info</a>
					<a class='btn btn-danger btn-md' href="?logout=1">Logi Välja</a>
				</h2>
			</div>

		</div>
	</div>

	
	
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-md-4">
				<h1>Loo uus treening</h1>
			</div>

			<div class="col-sm-4 col-md-5">
				<h1>Treeningute Nimekiri</h1>
			</div>
		</div>

		<div class="row">
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



			<div class="col-sm-4 col-sm-offset-2 col-md-8 col-md-offset-1">
				<label></label>
				
			<form>
			
		
			<div class="row">
				<div class="col-md-4">
					<div class="input-group">
						<input type="search" name="q" value="<?=$q;?>" class="form-control" placeholder="Otsi treeningut...">
						<span class="input-group-btn">
						
						<button class="btn btn-success" type="submit">Otsi <span class="glyphicon glyphicon-search"></span></button>
						
					</span>
					</div>
				</div>
			</div>
			
			
			
			
			</form>

			
			
			<?php



			$html = "<table class='table table-bordered table-condensed '>";

			$html .= "<tr>";
			//$html .= "<td>ID</td>";
			$html .= "<td class=\"active\" style=\"width: 20%\"><strong>Liik</strong></td>";
			$html .= "<td class=\"active\" style=\"width: 12%\"><strong>Kuupäev</strong></td>";
			$html .= "<td class=\"active\" style=\"width: 5%\"><strong>Aeg</strong></td>";
			$html .= "<td class=\"active\" style=\"width: 15%\"><strong>Asukoht</strong></td>";
			$html .= "<td class=\"active\" style=\"width: 40%\"><strong>Lisainfo</strong></td>";
			$html .= "<td class=\"active\" style=\"width: 5%\"><strong>Edit</strong></td>";
			$html .= "<td class=\"active\" style=\"width: 5%\"><strong>Liitu</strong></td>";
			$html .= "</tr>";

			foreach ($sport as $s) {

				$html .= "<tr>";
				//$html .= "<td>".$s->id."</td>";
				$html .= "<td>".$s->event."</td>";
				$html .= "<td>".$s->date."</td>";
				$html .= "<td>".$s->time."</td>";
				$html .= "<td>".$s->location."</td>";
				$html .= "<td>".$s->info."</td>";
				$html .= "<td><a class='btn btn-primary btn-xs' href='edit.php?id=".$s->id."'><span class='glyphicon glyphicon-pencil'></span></a></td>";
				$html .= "<td><a class='btn btn-success btn-xs' href='edit.php?id=".$s->id."'><span class='glyphicon glyphicon-ok'></span></a></td>";
				$html .= "</tr>";

			}

			$html .= "</table>";

			echo $html;


			?>
			</div>
		</div>
    </div>
	
    <?php require("../footer.php"); ?>
	
