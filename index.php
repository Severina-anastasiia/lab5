<?php
    require_once 'db.php';
    session_start();
    $nurseName=array();
    $nurseDep=array();
    $nurseShift=array();
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
        $expr2="SELECT `department` FROM `nurse`"; 
        $expr3="SELECT `shift` FROM `nurse`";
        
        $res1=$pdo->query($expr1);
        $res2=$pdo->query($expr2);
        $res3=$pdo->query($expr3);

        while($row=$res1->fetch()){
           array_push($nurseName, $row['name']);
        }
        
        while($row=$res2->fetch()){
            array_push($nurseDep, $row['department']);
        }
        
        while($row=$res3->fetch()){
			array_push($nurseShift, $row['shift']);
		}

        $nurseName2=array_unique($nurseName);
        $nurseDep2=array_unique($nurseDep);
        $nurseShift2=array_unique($nurseShift);
    ?>
    <div>
    <form action="result1.php" method="POST">
		<p>
			<lable for="nn">Choose nurse name</lable>
			<select name="nn" id="nn">
			<?php
				for($i=0;$i<count($nurseName2);$i++){
					if($nurseName2[$i]=="")
						continue;
					echo "<option value='".$nurseName2[$i]."'>".$nurseName2[$i]."</option>";
				}
			?>
			</select>
		</p>
		<p>
            <input type="submit" value="Show result">
        </p>
	</form>
	</div>
	
	<div>
	<form action="result2.php" method="POST">
		<p>
			<lable for="dep">Choose department</lable>
			<select name="dep" id="dep">
			<?php
				for($i=0;$i<count($nurseDep2);$i++){
					if($nurseDep2[$i]=="")
						continue;
					echo "<option value='".$nurseDep2[$i]."'>".$nurseDep2[$i]."</option>";
				}
			?>
			</select>
		</p>
		<p>
            <input type="submit" value="Show result">
        </p>
	</form>
	</div>
	
	<div>
	<form action="result3.php" method="POST">
		<p>
			<lable for="sh">Choose shift</lable>
			<select name="sh" id="sh">
			<?php
				for($i=0;$i<count($nurseShift2);$i++){
					if($nurseShift2[$i]=="")
						continue;
					echo "<option value='".$nurseShift2[$i]."'>".$nurseShift2[$i]."</option>";
				}
			?>
			</select>
		</p>
		<p>
            <input type="submit" value="Show result">
        </p>
    </form>
    </div>
    
    <form action="addNurse.php" method="POST">
		
		<p>
				<input type="submit" value="Add nurse">
		</p>
    </form>
    
    <form action="addWard.php" method="POST">
		<p>
				<input type="submit" value="Add ward">
		</p>
    </form>
    
    <form action="AppointNurse.php" method="POST">
		<p>
				<input type="submit" value="Appoint nurse">
		</p>
    </form>
    
</body>
</html>
