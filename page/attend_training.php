<?php
require("../functions.php");

require("../class/Helper.class.php");
$Helper = new Helper($mysqli);

require("../class/Event.class.php");
$Event = new Event($mysqli);



$s = $Event->getSingleEventData($_GET["id"]);
//var_dump($s);

if (isset($_GET["attend"])) {
		
		$Event->attendEvent($Helper->cleanInput($_GET["userid"]), $Helper->cleanInput($_GET["eventid"]));
		header("Location: data.php");
		
	}

?>

<?php require("../header.php"); ?>

<div class="container" style="width:100%;background-color:#EBEBE6;">
    <div class="row">
        <div class="col-sm-4 col-md-4 col-md-offset-1">
            <h1> Ühine treeninguga </h1>
        </div>

        <div class="col-sm-4 col-sm-offset-2 col-md-2 col-md-offset-5">
            <h1><a class='btn btn-info btn-md' href='data.php?id=".$s->id."'>Tagasi</a></h1>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-4 col-md-4 col-md-offset-1">

        
                <input type="hidden" name="id" value="<?=$_GET["id"];?>" >
			<br><br>
            <div class="form-group">
                <label for="event" >Treeningu Liik</label>
                <input class="form-control" id="event" name="event" type="text" value="<?=$s->event;?>" readonly>
            </div>

            <div class="form-group">
                <label for="date" >Kuupäev</label>
                <input class="form-control" id="date" name="date" type="date" value="<?=$s->date;?>" readonly>
            </div>

            <div class="form-group">
                <label for="time" >Kellaaeg</label>
                <input class="form-control" id="time" name="time" type="time" value="<?=$s->time;?>" readonly>
            </div>

            <div class="form-group">
                <label for="location" >Asukoht</label>
                <input class="form-control" id="location" name="location" type="text" value="<?=$s->location;?>" readonly>
            </div>

            <div class="form-group">
                <label for="info" >Lisainfo</label>
                <input class="form-control" id="info" name="info" type="text" value="<?=$s->info;?>" readonly>
            </div>
                <input class='btn btn-success btn-lg' type="submit" name="attend" value="Liitu">
				
			

                   
        </div>
    </div>
</div>

<?php require("../footer.php"); ?>

