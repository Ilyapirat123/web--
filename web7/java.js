let display = document.getElementById("display");
let currentInput = "";

function appendNumber(number) {
    currentInput += number;
    updateDisplay();
}

function appendOperator(operator) {
    if (currentInput !== "" && !isNaN(currentInput.slice(-1))) {
        currentInput += operator;
        updateDisplay();
    }
}

function appendDecimal() {
    if (!currentInput.includes(".")) {
        currentInput += ".";
        updateDisplay();
    }
}

function clearAll() {
    currentInput = "";
    updateDisplay();
}

function clearEntry() {
    currentInput = currentInput.slice(0, -1);
    updateDisplay();
}

function deleteLast() {
    currentInput = currentInput.slice(0, -1);
    updateDisplay();
}

function changeSign() {
    if (currentInput) {
        if (currentInput[0] === "-") {
            currentInput = currentInput.slice(1);
        } else {
            currentInput = "-" + currentInput;
        }
        updateDisplay();
    }
}

function reciprocal() {
    try {
        let value = parseFloat(currentInput);
        if (value === 0) {
            alert("Ошибка: деление на 0 невозможно");
            return;
        }
        currentInput = (1 / value).toString();
        updateDisplay();
    } catch {
        alert("Ошибка ввода");
    }
}

function sqrt() {
    try {
        let value = parseFloat(currentInput);
        if (value < 0) {
            alert("Ошибка: корень из отрицательного числа");
            return;
        }
        currentInput = Math.sqrt(value).toString();
        updateDisplay();
    } catch {
        alert("Ошибка ввода");
    }
}

function percentage() {
    try {
        currentInput = (parseFloat(currentInput) / 100).toString();
        updateDisplay();
    } catch {
        alert("Ошибка ввода");
    }
}

function calculate() {
    try {
        if (currentInput.includes("/0")) {
            alert("Ошибка: деление на 0 невозможно");
            currentInput = "";
            updateDisplay();
            return;
        }

        currentInput = eval(currentInput).toString();
        updateDisplay();
    } catch {
        alert("Ошибка выражения");
    }
}

function updateDisplay() {
    display.value = currentInput;
}
