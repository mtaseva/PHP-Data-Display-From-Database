<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prikazuvanje na podatoci od MySQL</title>

    <style>
        
        table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 50%;
        }

        th, td {
            border: 1px solid black;
            text-align: center;
        }

    </style>

</head>
<body>

    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "students";   // ime na bazata

    // Kreirame konekcija
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Ja proveruvame konekcijata
    if(!$conn) {
        die("Neuspesna konekcija: " . mysqli_connect_error());
    }

    // echo "Uspesna konekcija";

    // niza od tabelite vo bazata students.sql
    $tabeli = ['students', 'coaches', 'sports', 'sportgroups', 'students_sportgroups'];
    
    // pominuvame niz sekoja tabela i gi zemame podatocite
    foreach($tabeli as $tabela) {

        echo "<div class='table-container'>";
        echo "<h2>Table: $tabela</h2>";

        // SQL baranje za da se selektiraat site podatoci od tabelata
        $sql = "SELECT * FROM $tabela";
        $rezultat = mysqli_query($conn, $sql);

        if(mysqli_num_rows($rezultat) > 0) {

            // prikazuvanje na zaglavjeto na sekoja tabela soodvetno
            echo "<table>";
            echo "<tr>";

            // gi prikazuvame iminjata na kolonite kako naslov na tabelite (table header)
            while($field = mysqli_fetch_field($rezultat)) {
                echo "<th>{$field->name}</th>";
            }

            echo "</tr>";

            // gi prikazuvame redovite na tabelite (table row)
            while($row = mysqli_fetch_assoc($rezultat)) {

                echo "<tr>";

                foreach($row as $value) {
                    echo "<td>{$value}</td>";
                }

                echo "</tr>";

            }

            echo "</table>";

        } else {
            echo "<p style='text-align: center;'>Ne se pronajdeni podatoci vo tabelata `$tabela`.</p>";
        }

        echo "</div>";

    }

    mysqli_close($conn);

    ?>

</body>
</html>