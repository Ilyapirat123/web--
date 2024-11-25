let min = 1;
let max = 100;
let guess;
let history = [];

const output = document.getElementById('output');
const historyList = document.getElementById('history');
const historyTitle = document.getElementById('historyTitle');

function generateGuess() {
  guess = Math.floor((min + max) / 2);
  output.textContent = `Компьютер думает, что это число: ${guess}`;
  history.push(guess);
}

document.getElementById('less').addEventListener('click', () => {
  max = guess - 1;
  generateGuess();
});

document.getElementById('greater').addEventListener('click', () => {
  min = guess + 1;
  generateGuess();
});

document.getElementById('equal').addEventListener('click', () => {
  output.textContent = `Компьютер угадал! Это число: ${guess}`;
  document.querySelectorAll('button').forEach((button) => (button.disabled = true));
  
  historyTitle.style.display = 'block';
  historyList.style.display = 'block';

  historyList.innerHTML = '';
  history.forEach((num) => {
    const listItem = document.createElement('li');
    listItem.textContent = num;
    historyList.appendChild(listItem);
  });
});

generateGuess();
