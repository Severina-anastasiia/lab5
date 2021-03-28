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
    <?php
        $dep=$_POST['dep'];

        $expr1="SELECT `name` FROM `nurse` WHERE `department`=:dep";
        
        $res1=$pdo->prepare($expr1);

        $res1->execute(['dep'=>$dep]);
    ?>

	<p>Department number: <?php echo $dep?></p>
	<p>The list of nurses</p>
	<hr>
	<ul>
		<?php
			while($row=$res1->fetch()){
			echo "<li>".$row['name']."</li>";
			}
		?>
	</ul>
	<hr>

    <a href="index.php">Назад</a>
</body>
</html>
