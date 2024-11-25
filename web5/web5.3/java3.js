
function isDescendingArithmeticProgression(num) {
    const digits = Math.abs(num)
      .toString()
      .split("")
      .map(Number);
  
    if (digits.length < 2) return false; 
  
    const diff = digits[0] - digits[1];
    if (diff <= 0) return false; 
  
    for (let i = 1; i < digits.length - 1; i++) {
      if (digits[i] - digits[i + 1] !== diff) return false;
    }
  
    return true;
  }
  
  function filterArray(arr) {
    return arr.filter((el) => {
      const intPart = Math.floor(Math.abs(el));
      return !isDescendingArithmeticProgression(intPart);
    });
  }
  
  document.getElementById("filterButton").addEventListener("click", () => {
    const input = document.getElementById("inputArray").value;
    const array = input.split(",").map((el) => parseFloat(el.trim()));
  
    if (array.some(isNaN)) {
      document.getElementById("output").textContent = "Пожалуйста, введите корректный массив чисел.";
      return;
    }
  
    const result = filterArray(array);
    document.getElementById("output").textContent = `Результат: [${result.join(", ")}]`;
  });
  