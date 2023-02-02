<?php
    $searching_spz = "" ;
    $searching_znacka = "";
    $searching_typ = "";

    if(isset($_POST["submit"])){
        $searching_spz = addslashes($_POST["spz"]);
        $searching_znacka =addslashes($_POST["znacka"]);
        $searching_typ = addslashes($_POST["typ"]);
    }
    //pripojeni do databaze

    $connection = mysqli_connect("localhost","root","","evidence_vozidel");

    if(!$connection){
        die ("Nelze se pripojit k databazi");
    }
    
?>
<?php
    //vypis z databaze
    $queryVyhledavani = "SELECT * FROM vozidla WHERE(SPZ = '$searching_spz') AND (znacka = '$searching_znacka') AND (typ = '$searching_typ')";
    $resultVyhledavani = mysqli_query($connection,$queryVyhledavani);  
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
<a href="evidence_vozidel.php">Evidence vozidel</a>
<h2>Seznam odpovidajicih vozidel</h2>
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
                if($resultVyhledavani){
                    while ($row = mysqli_fetch_assoc($resultVyhledavani)) {
            ?>
                    <tr>
                        <td><?php echo $row["id_vozidla"];?></td>
                        <td><?php echo $row["SPZ"];?></td>
                        <td><?php echo $row["znacka"];?></td>
                        <td><?php echo $row["typ"];?></td>
                        <td><?php echo $row["popis"];?></td>
                    </tr>
                    <p>Vozidlo nalezeno!</p>
            <?php   }
                }else{
            ?>
                    <p>Vozidlo nenalezeno!</p>;
            <?php
                }
           ?>
        </tbody>
    </table>

<h2>Vyhledavani vozidla</h2>
<form action="vyhledavani_vozidel.php" method="post">
        <input type="text" name="spz" placeholder="SPZ"><br>
        <input type="text" name="znacka" placeholder="Značka"><br>
        <input type="text" name="typ" placeholder="Typ"><br>
        <input type="submit" name="submit" value="Vyhledat">
    </form>
</body>
</html> 