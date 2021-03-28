<?php
    require_once 'db.php';
    session_start();
    $nurses=array();
    $wards=array();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="style.css">    
    <title>Document</title>
</head>
<body>
	<?php
		$expr1="SELECT `name` FROM `nurse`";
        $expr2="SELECT `name` FROM `ward`"; 
        
        $res1=$pdo->query($expr1);
        $res2=$pdo->query($expr2);

        while($row=$res1->fetch()){
           array_push($nurses, $row['name']);
        }
        
        while($row=$res2->fetch()){
            array_push($wards, $row['name']);
        }
        
        $nurses2=array_unique($nurses);
        $wards2=array_unique($wards);
    ?>
	
	<form method="post">
		<p>
			
			<lable for="dep">Choose nurse: </lable>
			<select name="nameN" id="nameN">
			<?php
				for($i=0;$i<count($nurses2);$i++){
					if($nurses2[$i]=="")
						continue;
					echo "<option value='".$nurses2[$i]."'>".$nurses2[$i]."</option>";
				}
			?>
			</select>
		</p>
		
		<p>
			<lable for="sh">Choose ward: </lable>
			<select name="nameW" id="nameW">
			<?php
				for($i=0;$i<count($wards2);$i++){
					if($wards2[$i]=="")
						continue;
					echo "<option value='".$wards2[$i]."'>".$wards2[$i]."</option>";
				}
			?>
			</select>
		</p>
		<p>
			<input type="submit" name="add" value="Add">
		</p>
	</form>
	
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(isset($_POST["add"])) {
            $nameN=$_POST['nameN'];
			$nameW=$_POST['nameW'];
        
			$findInN="SELECT `id` FROM `nurse` WHERE `name`=:nameN";
			$res1=$pdo->prepare($findInN);

			$res1->execute();
			$row=$res1->fetch();
			$idN = $row[0]+1;
			
			$findInW="SELECT `id` FROM `ward` WHERE `name`=:nameW";

			$res2=$pdo->prepare($findInW);

			$res2->execute();
			$row=$res2->fetch();
			$idW = $row[0]+1;

			$expr1="INSERT INTO `nurse_ward`(`fid_nurse`,`fid_ward`) 
			VALUES('$idN', '$idW')";

			$res3=$pdo->prepare($expr1);

			$res3->execute();
		}
	}
    ?>
		
    <a href="index.php">Назад</a>
</body>
</html>
