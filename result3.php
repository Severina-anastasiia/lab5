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
        $sh=$_POST['sh'];

        $expr1="SELECT `nurse`.`name` as nurse, `ward`.`name` as ward FROM `nurse` 
        JOIN `nurse_ward` ON `nurse`.`id_nurse`=`nurse_ward`.`fid_nurse` 
        JOIN `ward` ON `nurse_ward`.`fid_ward`=`ward`.`id_ward` WHERE `nurse`.`shift`=:sh";

        $res1=$pdo->prepare($expr1);

        $res1->execute(['sh'=>$sh]);
    ?>
    
    <p>Shift number: <?php echo $sh?></p>
    <table>
        <tr>
            <th>Nurse's name</th>
            <th>Ward's name</th>
        </tr>

        <?php
            while($row=$res1->fetch()){
                echo "<tr>";
                echo "<td>".$row['nurse']."</td>";
                echo "<td>".$row['ward']."</td>";
                echo "</tr>";
            }
        ?>
    </table>
    
    <?php echo "<br><br><br>"?>
    
    <a href="index.php">Назад</a>
</body>
</html>
