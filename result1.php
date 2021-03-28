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
        $nn=$_POST['nn'];

        $expr1="SELECT `name` FROM `ward` JOIN `nurse_ward` ON
         `ward`.`id_ward`=`nurse_ward`.`fid_ward` 
         WHERE `fid_nurse`=(SELECT `id_nurse` FROM `nurse` WHERE `name`=:nn)";
         
        $res1=$pdo->prepare($expr1);

        $res1->execute(['nn'=>$nn]);
    ?>


	<p>Name nurse: <?php echo $nn?></p>
	<p>The list of wards</p>
	<hr>
	<ul>
		<?php
			while($row=$res1->fetch()){
			echo "<li>".$row['name']."</li>";
			}
		?>
	</ul>
	<hr>

    <?php echo "<br><br><br>"?>
    
    <a href="index.php">Назад</a>
</body>
</html>
