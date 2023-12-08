<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spill Tre på rad</title>
    <link rel="stylesheet" href="style.css"> <!-- Lenker til et stilark -->
</head>

<body>
    <div class="flex">

        <!-- PHP kode -->
        <?php
        // Database tilkoblingsdetaljer
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "mydb";

        // Opprett tilkobling til databasen
        $conn = new mysqli($servername, $username, $password, $database);

        // Sjekk om tilkoblingen er vellykket
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Variabler for spillere
        $PlayerX = "";
        $PlayerO = "";

        // Hvis skjemadata er sendt via POST
        if (isset($_POST["player1Name"])) {
            echo "<div class='absolute'>" . $_POST["player1Name"] . "<br>" . $_POST["player1Marker"] . "</div><div class='right'>" . $_POST["player2Name"] . "<br>" . $_POST["player2Marker"] . "</div>";
            if ($_POST["player1Marker"] == "X") {
                echo "<script> var playerX = '" . $_POST["player1Name"] . "';</script>";
                $PlayerX = $_POST["player1Name"];
                echo "<script> var playerO = '" . $_POST["player2Name"] . "';</script>";
                $PlayerO = $_POST["player2Name"];

            } else {
                echo "<script> var playerX = '" . $_POST["player2Name"] . "';</script>";
                $PlayerX = $_POST["player2Name"];
                echo "<script> var playerO = '" . $_POST["player1Name"] . "';</script>";
                $PlayerO = $_POST["player1Name"];
            }
        }
        // Hvis vinneren er angitt via POST
        if (isset($_POST["vinner"])) {
            $Vinner = $_POST["vinner"];
            $PlayerX = $_POST["X"];
            $PlayerO = $_POST["O"];

            ;
            $Query = "INSERT INTO stillinga(Spiller1, Spiller2, Vant) VALUES ('$PlayerX', '$PlayerO', '$Vinner')";
            echo $Query;
            mysqli_query($conn, $Query);
            header("location: index.php");
        }
        ?>
    </div>

    <!-- Vis spilleres navn og tidligere spillresultater -->
    <div class="absolute">
        <?php

        // Vis spiller X's navn og tidligere spillresultater fra databasen
        echo $PlayerX . "<br>";
        $Query = "select * from stillinga where Spiller1 = '$PlayerX' OR Spiller2 = '$PlayerX'";

        $result = mysqli_query($conn, $Query);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        while ($row = mysqli_fetch_assoc($result)) {

            echo $row["Spiller1"] . " vs " . $row["Spiller2"] . " - Vinner: " . $row["Vant"] . "<br>";
        }

        ?>
    </div>

    <div class="absolute right2 right">
        <?php

        // Vis spiller O's navn og tidligere spillresultater fra databasen
        echo $PlayerO . "<br>";
        $Query = "select * from stillinga where Spiller1 = '$PlayerO' OR Spiller2 = '$PlayerO'";

        $result = mysqli_query($conn, $Query);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        while ($row = mysqli_fetch_assoc($result)) {

            echo $row["Spiller1"] . " vs " . $row["Spiller2"] . " - Vinner: " . $row["Vant"] . "<br>";
        }

        ?>
    </div>

    <!-- Skjema for å sende inn vinneren av spillet -->
    <div class="vinner">
        <form action="" method="post" class="vinner" id="score">
            <input type="text" name="vinner" id="vinner" value="spill">
            <div class="none">
                <input type="text" name="X" value="<?php echo $PlayerX; ?>">
                <input type="text" name="O" value="<?php echo $PlayerO; ?>">

            </div>
            <button type="submit">send inn score</button>
        </form>
    </div>

    <!-- Spillebrettet med celler -->
    <div class="board">
        <!-- Hver celle har en klikkfunksjon for å gjøre et trekk -->
        <div class="cell" onclick="makeMove(0)"></div>
        <div class="cell" onclick="makeMove(1)"></div>
        <div class="cell" onclick="makeMove(2)"></div>
        <div class="cell" onclick="makeMove(3)"></div>
        <div class="cell" onclick="makeMove(4)"></div>
        <div class="cell" onclick="makeMove(5)"></div>
        <div class="cell" onclick="makeMove(6)"></div>
        <div class="cell" onclick="makeMove(7)"></div>
        <div class="cell" onclick="makeMove(8)"></div>
    </div>

    <script src="script.js"></script> <!-- Inkluderer JavaScript-filen -->
</body>

</html>