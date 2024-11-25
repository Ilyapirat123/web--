function countCommonWords() {
    const sentence1 = document.getElementById('sentence1').value;
    const sentence2 = document.getElementById('sentence2').value;

    const words1 = sentence1.toLowerCase().split(/\s+/).filter(word => word);
    const words2 = sentence2.toLowerCase().split(/\s+/).filter(word => word);

    const commonWords = words1.filter(word => words2.includes(word));

    const uniqueCommonWords = [...new Set(commonWords)];

    document.getElementById('result').textContent = `Общие слова: ${uniqueCommonWords.join(', ')}. Количество общих слов: ${uniqueCommonWords.length}`;
}
