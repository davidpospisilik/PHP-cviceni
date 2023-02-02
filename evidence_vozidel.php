<?php
    $spz = "" ;
    $znacka = "";
    $typ = "";
    $popis = "";

    //pripojeni do databaze

    $connection = mysqli_connect("localhost","root","","evidence_vozidel");

    if(!$connection){
        die ("Nelze se pripojit k databazi");
    }

    if(isset($_POST["submit"])){
        echo "Data byla odeslana!";
        $spz = addslashes($_POST["spz"]);
        $znacka =addslashes($_POST["znacka"]);
        $typ = addslashes($_POST["typ"]);
        $popis = addslashes($_POST["popis"]);

        //zapis do databaze
        $query = "INSERT INTO vozidla(SPZ,znacka,typ,popis)VALUES('$spz','$znacka','$typ','$popis')";
        $result = mysqli_query($connection,$query);

        if(!$result){
            die ("Dotaz do databaze selhal".mysqli_error());
        }
    }
?>
<?php
    //vypis z databaze
    $queryVypis = "SELECT * FROM vozidla";
    $resultVypis = mysqli_query($connection,$queryVypis);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="vyhledavani_vozidel.php">Vyhledavani vozidel</a>
    <h2>Seznam vozidel</h2>
    <table class="table">
        <thead>
            <th>ID</th>
            <th>SPZ</th>
            <th>Znacka</th>
            <th>Typ</th>
            <th>Popis</th>
        </thead>
        <tbody>
            <?php
                if (mysqli_num_rows($resultVypis) > 0) {
                    while ($row = mysqli_fetch_assoc($resultVypis)) {
            ?>
                        <tr>
                            <td><?php echo $row["id_vozidla"];?></td>
                            <td><?php echo $row["SPZ"];?></td>
                            <td><?php echo $row["znacka"];?></td>
                            <td><?php echo $row["typ"];?></td>
                            <td><?php echo $row["popis"];?></td>
                        </tr>
            <?php   }
                } else{
                    echo "Zatim nejsou evidovana zadna vozidla.";
                }  
           ?>
        </tbody>
    </table>
    <form action="evidence_vozidel.php" method="post">
        <input type="text" name="spz" placeholder="SPZ"><br>
        <input type="text" name="znacka" placeholder="Značka"><br>
        <input type="text" name="typ" placeholder="Typ"><br>
        <textarea name="popis" placeholder="Popis"></textarea><br>
        <input type="submit" name="submit" value="Pridat">
    </form>
</body>
</html>