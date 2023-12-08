<?php
// Starter en PHP-kode for å lagre info for neste side
session_start()
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tre på rad</title>
    <link rel="stylesheet" href="style.css"> <!-- Kobler til stilarkfilen -->
</head>

<body div class="body">
    <!-- for å spørre dere om å starte spillet -->
    <div id="startModal" class="modal">
        <div class="modal-content">
            <p>Vil du starte å spille tre på rad?</p>
            <button onclick="startGame()">Ja</button>
            <button onclick="closeModal()">Nei</button>
        </div>
    </div>

    <form id="playerForm" action="spillet.php" method="POST">
        <!-- Skjema for å samle inn spillernes informasjon -->
        <label for="player1Name">Spiller 1 navn:</label>
        <input required="" type="text" id="player1Name" name="player1Name">
        <label for="player1Marker">Velg brikke:</label>
        <select required="" id="player1Marker" name="player1Marker" onchange="select()">
            <option value=""></option>
            <option value="X">X</option>
            <!--  <option value="O">O</option>-->
        </select>

        <label for="player2Name">Spiller 2 navn:</label>
        <input required="" type="text" id="player2Name" name="player2Name">
        <label for="player2Marker">Velg brikke:</label>
        <select required="" id="player2Marker" name="player2Marker">
            <!-- Dette feltet er tomt, antakelig for valg av spiller 2s brikke -->
        </select>

        <!-- Innsending av skjema for å starte spillet -->
        <input type="submit" value="Start spill" onclick="startGame()">
    </form>

    <p>Er du ny på siden og lurer på hvordan siden fungerer? Trykk <a href="Opplaeringsmateriale_til_sluttsbruker.pdf" target="_blank"> her</a></p>
    <p>Nysgjerrig på hvordan man lager database? Trykk <a href="Opplaeringsmateriale_til_it_laerling.pdf" target="_blank"> her</a></p>

    <script src="script.js"></script><!-- Inkluderer JavaScript-filen -->
</body>

</html>