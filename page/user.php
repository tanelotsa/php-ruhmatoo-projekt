<?php
    require("../functions.php");

    require("../class/Helper.class.php");
    $Helper = new Helper($mysqli);
	
	require("../class/Interest.class.php");
	$Interest = new Interest($mysqli);
	
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
	
	
	
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
		unset($_SESSION["message"]);
	}
	
	
	if ( isset($_POST["interest"]) && 
		!empty($_POST["interest"])
	  ) {
		  
		
		$Interest->saveInterest($Helper->cleanInput($_POST["interest"]));
		
	}
	

    $interests = $Interest->getAllInterests();


?>

<?php require("../header.php"); ?>

    <div class="container" style="width:100%;background-color:#EBEBE6;">
        <div class="row">
            <div class="col-sm-4 col-md-4 col-md-offset-1">
                <h1> Kasutaja info </h1>
            </div>

            <div class="col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-3">
                <h1><a class='btn btn-info btn-md' href='data.php?id=".$s->id."'>Tagasi</a></h1>
            </div>
        </div>
    </div>

    <div class="container">
        <h2><strong>Nimi: </strong><?=$_SESSION["userName"];?></h2>
        <h2><strong>Sugu:</strong> <?=$_SESSION["userGender"];?></h2>
        <h2><strong>Elukoht: </strong><?=$_SESSION["userLocation"];?></h2>
        <h2><strong>Sünnikuupäev:</strong> <?=$_SESSION["userBirthDate"];?></h2>
    
	
	
	
	<h2>Salvesta huvi</h2>

	<form method="POST">
		
		<label>Hobi/huviala nimi</label><br>
		<input name="interest" type="text">
		
		<input type="submit" value="Salvesta">
		
	</form>
	</div>
<h2>Arhiiv</h2>
	
<?php
	
	
	$html = "<table>";
	
		$html .= "<tr>";
			//$html .= "<td>ID</td>";
			$html .= "<td>Huviala</td>";
		$html .= "</tr>";
		
		foreach ($interests as $i) {
			
			$html .= "<tr>";
				//$html .= "<td>".$s->id."</td>";
				$html .= "<td>".$i->interest."</td>";
				$html .= "<td><a href='edit.php?id=".$i->id."'>edit.php</a></td>";
			$html .= "</tr>";
			
		}
		
	$html .= "</table>";
	
	echo $html;	
	
	
?>

<h2>Kasutaja hobid</h2>
<form method="POST">
	
	<label>Hobi/huviala nimi</label><br>
	<select name="userInterest" type="text">
        <?php
            
            $listHtml = "";
        	
        	foreach($interests as $i){
        		
        		
        		$listHtml .= "<option value='".$i->id."'>".$i->interest."</option>";
        
        	}
        	
        	echo $listHtml;
            
        ?>
    </select>
    	
	
	<input type="submit" value="Lisa">
	
</form>

<?php require("../footer.php"); ?>
