<?php
require("../functions.php");

require("../class/Helper.class.php");
$Helper = new Helper($mysqli);

require("../class/Event.class.php");
$Event = new Event($mysqli);


if(isset($_POST["update"])){
    $Event->updateEvent($Helper->cleanInput($_POST["id"]), $Helper->cleanInput($_POST["event"]), $Helper->cleanInput($_POST["date"]), $Helper->cleanInput($_POST["time"]),$Helper->cleanInput($_POST["location"]),$Helper->cleanInput($_POST["info"]));

    header("Location: data.php?id=".$_POST["id"]."&success=true");

    exit();
}

$s = $Event->getSingleEventData($_GET["id"]);
//var_dump($s);

if(isset($_GET["delete"])){
    $Event->deleteEvent($_GET["id"]);
    header("Location: data.php");
    exit();
}

?>

<?php require("../header.php"); ?>

<div class="container" style="width:100%;background-color:lightgray;">
    <div class="row">
        <div class="col-sm-4 col-md-4 col-md-offset-1">
            <h1> Muuda treeningut </h1>
        </div>

        <div class="col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-3">
            <h1><a class='btn btn-info btn-md' href='data.php?id=".$s->id."'>Tagasi</a></h1>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-4 col-md-4 col-md-offset-1">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >

                <input type="hidden" name="id" value="<?=$_GET["id"];?>" >

            <div class="form-group">
                <label for="event" >Treeningu Liik</label>
                <input class="form-control" id="event" name="event" type="text" value="<?=$s->event;?>" >
            </div>

            <div class="form-group">
                <label for="date" >Kuupäev</label>
                <input class="form-control" id="date" name="date" type="date" value="<?=$s->date;?>">
            </div>

            <div class="form-group">
                <label for="time" >Kellaaeg</label>
                <input class="form-control" id="time" name="time" type="time" value="<?=$s->time;?>">
            </div>

            <div class="form-group">
                <label for="location" >Asukoht</label>
                <input class="form-control" id="location" name="location" type="text" value="<?=$s->location;?>">
            </div>

            <div class="form-group">
                <label for="info" >Lisainfo</label>
                <input class="form-control" id="info" name="info" type="text" value="<?=$s->info;?>">
            </div>
                <input class='btn btn-info btn-md' type="submit" name="update" value="Muuda">

            <a class='btn btn-danger btn-md' href="?id=<?=$_GET["id"];?>&delete=true">Kustuta</a>
        </form>
        </div>
    </div>
</div>

<?php require("../footer.php"); ?>

