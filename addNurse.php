<?php
    require_once 'db.php';
    session_start();
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
        $expr2="SELECT `department` FROM `nurse`"; 
        $expr3="SELECT `shift` FROM `nurse`";
        
        $res2=$pdo->query($expr2);
        $res3=$pdo->query($expr3);

        while($row=$res2->fetch()){
            array_push($nurseDep, $row['department']);
        }
        
        while($row=$res3->fetch()){
			array_push($nurseShift, $row['shift']);
		}
		
        $nurseDep2=array_unique($nurseDep);
        $nurseShift2=array_unique($nurseShift);

    ?>
	<form method="post">
	<p>
			<lable>Enter nurse name: </lable>
			<input type="text" id="name" name="name" required
			minlength="4" maxlength="18" size="20">
		</p>
		
		<p>
			<lable>Enter data when nurse start working: </lable>
			<input type="date" id="date" name="date" value="2021-03-27"
			min="2020-01-01" max="2022-12-31">
		</p>
		
		<p>
			<lable for="dep">Choose department: </lable>
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
			<lable for="sh">Choose shift: </lable>
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
			<input type="submit" name="add" value="Add">
		</p>
		</form>
	<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['add'])) {
		$name=$_POST['name'];
		$date=$_POST['date'];
		$dep=$_POST['dep'];
		$sh=$_POST['sh'];
		
		$sql = "SELECT MAX(`id_nurse`) FROM `nurse`";
		$res1=$pdo->prepare($sql);

        $res1->execute();
        $row=$res1->fetch();
		$id = $row[0]+1;
		
		$expr1 = "INSERT INTO nurse (id_nurse, name, date, department, shift)
		VALUES ('$id', '$name', '$date', '$dep', '$sh')";
		$res2=$pdo->prepare($expr1);
		$res2->execute();
		}
	}
	?>
	
	</form>
		
    <a href="index.php">Назад</a>
</body>
</html>
