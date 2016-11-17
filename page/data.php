    <?php
    require("../functions.php");

    require("../class/Helper.class.php");
    $Helper = new Helper($mysqli);

    if (!isset($_SESSION["userId"])) {
        header("Location: login.php");  //iga headeri järele tuleks lisada exit
        exit();
    }


    if (isset($_GET["logout"])) {

        session_destroy();

        header("Location: login.php");
        exit();
    }

    ?>

    <?php require("../header.php"); ?>
    <div class="container">
        <div class="row">


            <h3>
                Tere tulemast <?=$_SESSION["userName"];?>!
                <a href="?logout=1">Logi Välja</a>
            </h3>








        </div>

    </div>
    <?php require("../footer.php"); ?>