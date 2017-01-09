<?php
require("../functions.php");

require("../class/Helper.class.php");
$Helper = new Helper($mysqli);

require("../class/Event.class.php");
$Event = new Event($mysqli);


$myArchive = $Event->myAttendedEventsArchive();

?>
<?php require("../header.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-4 col-md-3 col-md-offset-1">
            <h2> Treeningute arhiiv </h2>
        </div>
<h2>
        <div class="col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-5">
            <a class='btn btn-info btn-md' href='training.php?id=".$s->id."'>Tagasi</a>
        </div>
</h2>
    </div>
<?php



$html = "<table class='table table-bordered table-condensed '>";

$html .= "<tr>";


//$html .= "<td>ID</td>";
$html .= "<td class=\"active\" style=\"width: 20%\"><strong>Liik</strong></td>";
$html .= "<td class=\"active\" style=\"width: 15%\"><strong>Kuupäev </a></strong></td>";
$html .= "<td class=\"active\" style=\"width: 5%\"><strong>Aeg</strong></td>";
$html .= "<td class=\"active\" style=\"width: 15%\"><strong>Asukoht</strong></td>";
$html .= "<td class=\"active\" style=\"width: 40%\"><strong>Lisainfo</strong></td>";
$html .= "<td class=\"active\" style=\"width: 5%\"><strong>Kohti</strong></td>";
$html .= "<td class=\"active\" style=\"width: 5%\"><strong>Osaleb</strong></td>";
//$html .= "<td class=\"active\" style=\"width: 5%\"><strong>Edit</strong></td>";
//$html .= "<td class=\"active\" style=\"width: 5%\"><strong>Liitu</strong></td>";
$html .= "</tr>";

foreach ($myArchive as $a) {

    $html .= "<tr>";
    //$html .= "<td>".$s->id."</td>";
    $html .= "<td>".$a->event."</td>";
    $html .= "<td>".$a->date."</td>";
    $html .= "<td>".$a->time."</td>";
    $html .= "<td>".$a->location."</td>";
    $html .= "<td>".$a->info."</td>";
    $html .= "<td>".$a->places."</td>";
    $html .= "<td>".$a->count."</td>";
    //$html .= "<td><a class='btn btn-primary btn-xs' href='edit.php?id=".$s->id."'><span class='glyphicon glyphicon-pencil'></span></a></td>";
    //$html .= "<td><a class='btn btn-success btn-xs' href='attend_training.php?id=".$m->id."'><span class='glyphicon glyphicon-ok'></span></a></td>";
    $html .= "</tr>";

}

$html .= "</table>";

echo $html;


?>
</div>


<?php require("../footer.php"); ?>