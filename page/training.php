<?php
    require("../functions.php");

    require("../class/Helper.class.php");
    $Helper = new Helper($mysqli);

    require("../class/Event.class.php");
    $Event = new Event($mysqli);

    $training = $Event->editMyEvent();
	
	
	
	if (isset($_GET["q"])) {
		
		$q = $_GET["q"];
	
	} else {
		//ei otsi
		$q = "";
	}
	$sort = "id";
	$order = "ASC";
	
	if(isset($_GET["sort"]) && (isset($_GET["order"]))) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}
	$myattend = $Event->myAttendedEvents($q, $sort, $order);

?>

<?php require("../header.php"); ?>

<div class="container" style="width:100%;background-color:#EBEBE6;">
    <div class="row">

        <div class="col-sm-4 col-md-3 col-md-offset-1">
            <h1> Treeningute leht </h1>
        </div>

        <div class="col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-5">
        <h2>
            <a class='btn btn-default btn-md' href='data.php?id=".$s->id."'>Treeningute arhiiv</a>

            <a class='btn btn-info btn-md' href='data.php?id=".$s->id."'>Tagasi</a>
        </h2>
        </div>

    </div>
</div>

<div class="container">
    <h2> Tulevad Treeningud </h2>
	
<?php



			$html = "<table class='table table-bordered table-condensed '>";

			$html .= "<tr>";
			
			$orderDate = "ASC";
        if (isset($_GET["order"]) &&
            $_GET["order"] == "ASC" &&
            $_GET["sort"] == "date" ) {
            $orderDate = "DESC";
        }
			//$html .= "<td>ID</td>";
			$html .= "<td class=\"active\" style=\"width: 20%\"><strong>Liik</strong></td>";
			$html .= "<td class=\"active\" style=\"width: 15%\"><strong>Kuupäev <a href='?q=".$q."&sort=date&order=".$orderDate."'><span class='glyphicon glyphicon-sort text-success'></span></a></strong></td>";
			$html .= "<td class=\"active\" style=\"width: 5%\"><strong>Aeg</strong></td>";
			$html .= "<td class=\"active\" style=\"width: 15%\"><strong>Asukoht</strong></td>";
			$html .= "<td class=\"active\" style=\"width: 40%\"><strong>Lisainfo</strong></td>";
			$html .= "<td class=\"active\" style=\"width: 5%\"><strong>Kohti</strong></td>";
			$html .= "<td class=\"active\" style=\"width: 5%\"><strong>Osaleb</strong></td>";
			//$html .= "<td class=\"active\" style=\"width: 5%\"><strong>Edit</strong></td>";
			//$html .= "<td class=\"active\" style=\"width: 5%\"><strong>Liitu</strong></td>";
			$html .= "</tr>";

			foreach ($myattend as $m) {

				$html .= "<tr>";
				//$html .= "<td>".$s->id."</td>";
				$html .= "<td>".$m->event."</td>";
				$html .= "<td>".$m->date."</td>";
				$html .= "<td>".$m->time."</td>";
				$html .= "<td>".$m->location."</td>";
				$html .= "<td>".$m->info."</td>";
				$html .= "<td>".$m->places."</td>";
				$html .= "<td>".$m->count."</td>";
				//$html .= "<td><a class='btn btn-primary btn-xs' href='edit.php?id=".$s->id."'><span class='glyphicon glyphicon-pencil'></span></a></td>";
				//$html .= "<td><a class='btn btn-success btn-xs' href='attend_training.php?id=".$m->id."'><span class='glyphicon glyphicon-ok'></span></a></td>";
				$html .= "</tr>";

			}

			$html .= "</table>";

			echo $html;


			?>

    <h2> Minu loodud treeningud </h2>
<?php

$html = "<table class='table table-bordered table-condensed '>";

$html .= "<tr>";
//$html .= "<td>ID</td>";
$html .= "<td class=\"active\" style=\"width: 20%\"><strong>Liik</strong></td>";
$html .= "<td class=\"active\" style=\"width: 12%\"><strong>Kuupäev</strong></td>";
$html .= "<td class=\"active\" style=\"width: 5%\"><strong>Aeg</strong></td>";
$html .= "<td class=\"active\" style=\"width: 15%\"><strong>Asukoht</strong></td>";
$html .= "<td class=\"active\" style=\"width: 40%\"><strong>Lisainfo</strong></td>";
$html .= "<td class=\"active\" style=\"width: 5%\"><strong>Kohti</strong></td>";
//$html .= "<td class=\"active\" style=\"width: 5%\"><strong>Osalejaid</strong></td>";
$html .= "<td class=\"active\" style=\"width: 5%\"><strong>Edit</strong></td>";
//$html .= "<td class=\"active\" style=\"width: 5%\"><strong>Liitu</strong></td>";
$html .= "</tr>";

foreach ($training as $t) {

    $html .= "<tr>";
    //$html .= "<td>".$s->id."</td>";
    $html .= "<td>".$t->event."</td>";
    $html .= "<td>".$t->date."</td>";
    $html .= "<td>".$t->time."</td>";
    $html .= "<td>".$t->location."</td>";
    $html .= "<td>".$t->info."</td>";
    $html .= "<td>".$t->places."</td>";
    //$html .= "<td>".$s->attenders."</td>";
    $html .= "<td><a class='btn btn-primary btn-xs' href='edit.php?id=".$t->id."'><span class='glyphicon glyphicon-pencil'></span></a></td>";
    //$html .= "<td><a class='btn btn-success btn-xs' href='attend_training.php?id=".$s->id."'><span class='glyphicon glyphicon-ok'></span></a></td>";
    $html .= "</tr>";

}

$html .= "</table>";

echo $html;

?>


</div>
<?php require("../footer.php"); ?>
