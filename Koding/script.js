let gameOver = false; // Variabel som holder styr på om spillet er ferdig
let cells = document.querySelectorAll('.cell'); // Henter alle elementer med klassen 'cell' (spillebrettcellene)
let currentPlayer = 'X'; // Holder styr på hvilken spiller som er i tur
let formEL = document.getElementById("score") // Henter skjemaet med ID 'score'

// Funksjon for å vise modalen
function showModal() {
  const modal = document.getElementById('startModal');
}

// Funksjon som aktiveres når spilleren velger brikke
function select() {
  // Utfører handlinger basert på valgt brikke av spiller 1
  console.log("kjører");
  console.log(document.getElementById('player1Marker').value);

  if (document.getElementById('player1Marker').value === "X") {
    // Sjekker om verdien til spiller er "X"
    var player2MarkerSelect = document.getElementById('player2Marker');
    // Velger elementet for valg av spiller 2s marker

    // Oppretter et nytt valg i dropdown-listen
    var newOption = document.createElement('option');

    newOption.value = "O"; // Setter verdien for det nye valget til "O"
    newOption.textContent = "O"; // Viser teksten "O" for det nye valget

    player2MarkerSelect.appendChild(newOption);
    // Legger til det nye valget i dropdown-listen for spiller 2s

  }
  else if (document.getElementById('player1Marker').value === "O") {
    // Hvis verdien til spiller er "O"
    var player2MarkerSelect = document.getElementById('player2Marker');


    // Oppretter et nytt valg i dropdown-listen
    var newOption = document.createElement('option');

    newOption.value = "X"; // Setter verdien for det nye valget til "X"
    newOption.textContent = "X"; // Viser teksten "X" for det nye valget

    player2MarkerSelect.appendChild(newOption);
    // Legger til det nye valget i dropdown-listen for spiller 2s

  }
}

// Funksjon for å starte spillet etter at brukeren klikker 'Ja'
function startGame() {
  closeModal(); // Skjul modalen
  // Start spillet med valgene fra brukeren
}

// Vis modalen når siden lastes
window.onload = showModal;

// Funksjon som utføres når en spiller klikker på en celle i spillebrettet
function makeMove(index) {
  // Utfører handlinger når spilleren gjør et trekk på spillebrettet
  if (!gameOver && cells[index].innerHTML === '') {
    cells[index].innerHTML = currentPlayer;
    checkWin();
    currentPlayer = currentPlayer === 'X' ? 'O' : 'X';
  }
}

// Funksjon for å sjekke om det er en vinner eller uavgjort
function checkWin() {
  // Sjekker spillebrettet for vinnerkombinasjoner eller uavgjort
  const winConditions = [
    [0, 1, 2], [3, 4, 5], [6, 7, 8],
    [0, 3, 6], [1, 4, 7], [2, 5, 8],
    [0, 4, 8], [2, 4, 6]
  ];

  let winningCombinations = [];
  for (let condition of winConditions) {
    if (
      cells[condition[0]].innerHTML !== '' &&
      cells[condition[0]].innerHTML === cells[condition[1]].innerHTML &&
      cells[condition[1]].innerHTML === cells[condition[2]].innerHTML
    ) {
      gameOver = true;
      winningCombinations.push(condition);
    }
  }


  if (winningCombinations.length > 0) {
    for (let combination of winningCombinations) {
      cells[combination[0]].style.backgroundColor = 'green';
      cells[combination[1]].style.backgroundColor = 'green';
      cells[combination[2]].style.backgroundColor = 'green';
    }
    console.log(document.getElementById("vinner").value);
    document.getElementById("vinner").value = "uavgjort";
    console.log(currentPlayer)
    if (currentPlayer === "X") {
      document.getElementById("vinner").value = playerX;
    } else if (currentPlayer === "O") {
      document.getElementById("vinner").value = playerO;
    }

    alert(currentPlayer + ' Gratulerer du har vunnet!');
    showRestartButton();
    return;
  }

  if ([...cells].every(cell => cell.innerHTML !== '')) {
    gameOver = true;

    showRestartButton();
    alert('Uavgjort!');
  }

}

// Funksjon som viser en knapp for å starte spillet på nytt
function showRestartButton() {
  const button = document.createElement('button');
  button.innerText = 'Spill på nytt';
  button.addEventListener('click', restartGame);
  document.body.appendChild(button);
  // Oppretter en knapp og legger til lytter for å starte spillet på nytt
}

// Funksjon for å starte spillet på nytt
function restartGame() {
  // Nullstiller spillebrettet og spillets tilstand for å starte på nytt
  cells.forEach(cell => {
    cell.innerHTML = '';
    cell.style.backgroundColor = '';
  });
  gameOver = false;
  currentPlayer = 'X';
  const restartButton = document.querySelector('button');
  if (restartButton) {
    restartButton.parentNode.removeChild(restartButton);
  }
}
