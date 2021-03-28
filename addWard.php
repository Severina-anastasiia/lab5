<?php
    require_once 'db.php';
    session_start();
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
	
	<form method="post">
		<p>
			<lable>Enter ward name</lable>
			<input type="text" id="name" name="name" required
			minlength="4" maxlength="8" size="15">
		</p>
		<p>
			<input type="submit" name="add" value="Add">
		</p>
	</form>
	
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['add'])) {
        $name=$_POST['name'];
        
		$sql = "SELECT MAX(`id__ward`) FROM `ward`";
		$res1=$pdo->prepare($sql);

        $res1->execute();
        $row=$res1->fetch();
		$id = $row[0]+1;

			$expr1="INSERT INTO `ward`(`id_ward`,`name`) 
			VALUES('$id', '$name')";

			$res1=$pdo->prepare($expr1);

			$res1->execute();
		} 
	}
    ?>
		
    <a href="index.php">Назад</a>
</body>
</html>
