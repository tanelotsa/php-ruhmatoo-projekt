<?php
    require("../functions.php");

    require("../class/Helper.class.php");
    $Helper = new Helper($mysqli);







?>

<?php require("../header.php"); ?>

<div class="container" style="width:100%;background-color:#EBEBE6;">
    <div class="row">
        <div class="col-sm-4 col-md-4 col-md-offset-1">
            <h1> Treeningute leht </h1>
        </div>

        <div class="col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-3">
            <h1><a class='btn btn-info btn-md' href='data.php?id=".$s->id."'>Tagasi</a></h1>
        </div>
    </div>
</div>

<?php require("../footer.php"); ?>
