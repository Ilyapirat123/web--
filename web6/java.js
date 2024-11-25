document.getElementById('credit-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    let isValid = true;

    document.querySelectorAll('.error-text').forEach(el => el.textContent = '');

    form.querySelectorAll('input[required], select[required], textarea[required]').forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            field.nextElementSibling.textContent = 'Это поле обязательно для заполнения';
        }
    });

    const email = form.querySelector('#email');
    if (email.value && !email.value.includes('@')) {
        isValid = false;
        email.nextElementSibling.textContent = 'Введите корректный email';
    }

    const phone = form.querySelector('#phone');
    if (phone.value && !/^(\+7|8|(\+37529))\d+$/.test(phone.value)) {
        isValid = false;
        phone.nextElementSibling.textContent = 'Введите корректный номер телефона. Телефон должен начинаться с +7, 8 или +37529.';
    }

    if (isValid) {
        const result = document.querySelector('.result');
        result.innerHTML = `
            <h3>Данные вашей заявки:</h3>
            <ul>
                <li><strong>Ф.И.О.:</strong> ${formData.get('full-name')}</li>
                <li><strong>Дата рождения:</strong> ${formData.get('birthdate')}</li>
                <li><strong>Email:</strong> ${formData.get('email')}</li>
                <li><strong>Телефон:</strong> ${formData.get('phone')}</li>
                <li><strong>Пол:</strong> ${formData.get('gender') === 'male' ? 'Мужской' : 'Женский'}</li>
                <li><strong>Образование:</strong> ${formData.get('education') === 'basic' ? 'Базовое' : 
                    formData.get('education') === 'secondary' ? 'Среднее' : 'Высшее'}</li>
                <li><strong>Хобби:</strong> ${formData.get('hobbies') === 'sport' ? 'Спорт' :
                    formData.get('hobbies') === 'programming' ? 'Программирование' : 'Рисование'}</li>
                <li><strong>О себе:</strong> ${formData.get('about')}</li>
                <li><strong>Сумма кредита:</strong> ${formData.get('loan-amount')}</li>
                <li><strong>Срок кредита:</strong> ${formData.get('loan-term')}</li>
                <li><strong>Ежемесячный доход:</strong> ${formData.get('income')}</li>
            </ul>
        `;

        form.reset(); 
    }
});
