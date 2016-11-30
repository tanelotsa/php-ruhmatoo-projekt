<?php
    require("../functions.php");

    require("../class/Helper.class.php");
    $Helper = new Helper($mysqli);

    require("../class/Event.class.php");
    $Event = new Event($mysqli);

    $training = $Event->editMyEvent();


?>

<?php require("../header.php"); ?>

<div class="container" style="width:100%;background-color:#EBEBE6;">
    <div class="row">
        <div class="col-sm-4 col-md-4 col-md-offset-1">
            <h1> Treeningute leht </h1>
        </div>

        <div class="col-sm-4 col-sm-offset-2 col-md-2 col-md-offset-5">
            <h1><a class='btn btn-info btn-md' href='data.php?id=".$s->id."'>Tagasi</a></h1>
        </div>
    </div>
</div>

<div class="container">
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
<h2> Tulevad Treeningud </h2>


</div>
<?php require("../footer.php"); ?>
