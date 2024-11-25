function degreesToRadians(degrees) {
    return degrees * (Math.PI / 180);
  }
  
  document.getElementById('calculateBtn').addEventListener('click', () => {
    const input = document.getElementById('arrayInput').value;
  
    const array = input.split(',').map((item) => parseFloat(item.trim()));
  
    if (array.some(isNaN)) {
      document.getElementById('result').textContent = 'Ошибка: Введите корректный массив чисел.';
      return;
    }
  
    const radiansArray = array.map(degreesToRadians);
  
    let product = 1;
    let foundNegativeCosine = false;
  
    for (let i = 0; i < radiansArray.length; i++) {
      const cosValue = Math.cos(radiansArray[i]);
      if (cosValue < 0) {
        foundNegativeCosine = true;
        break;
      }
      product *= array[i];
    }
  
    if (!foundNegativeCosine) {
      document.getElementById('result').textContent = 'Косинус всех элементов положительный. Произведение не завершено.';
      return;
    }
  
    document.getElementById('result').textContent = `Произведение элементов: ${product}`;
  });
  