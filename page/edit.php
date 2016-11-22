<?php
require("../functions.php");

require("../class/Helper.class.php");
$Helper = new Helper($mysqli);

require("../class/Event.class.php");
$Event = new Event($mysqli);

$s = $Event->getSingleEventData($_GET["id"]);
//var_dump($s);

if(isset($_POST["update"])){
    $Event->updateEvent($Helper->cleanInput($_POST["id"]), $Helper->cleanInput($_POST["event"]), $Helper->cleanInput($_POST["date"]), $Helper->cleanInput($_POST["time"]),$Helper->cleanInput($_POST["location"]),$Helper->cleanInput($_POST["info"]));
    header("Location: edit.php?id=".$_POST["id"]."&success=true");
    exit();
}

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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >

            <input type="hidden" name="id" value="<?=$_GET["id"];?>" >

            <label for="event" >Treeningu Liik</label><br>
            <input id="event" name="event" type="text" value="<?=$s->event;?>" ><br><br>

            <label for="date" >Kuupäev</label><br>
            <input id="date" name="date" type="date" value="<?=$s->date;?>"><br><br>

            <label for="time" >Kellaaeg</label><br>
            <input id="time" name="time" type="time" value="<?=$s->time;?>"><br><br>

            <label for="location" >Asukoht</label><br>
            <input id="location" name="location" type="text" value="<?=$s->location;?>"><br><br>

            <label for="info" >Lisainfo</label><br>
            <input id="info" name="info" type="text" value="<?=$s->info;?>"><br><br>

            <input type="submit" name="update" value="Muuda">
        </form>
        <a href="?id=<?=$_GET["id"];?>&delete=true">Kustuta</a>
    </div>
</div>

<?php require("../footer.php"); ?>

