// Общие функции JavaScript для приложения
document.addEventListener('DOMContentLoaded', function() {
    // Подтверждение удаления
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Вы уверены, что хотите удалить эту запись?')) {
                e.preventDefault();
            }
        });
    });

    // Подсветка активного пункта меню
    const currentUrl = window.location.href;
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        if (currentUrl.includes(link.getAttribute('href'))) {
            link.classList.add('active');
        }
    });
});

// Функция для расчета стоимости бронирования
function calculateBookingPrice(roomId, checkInDate, checkOutDate) {
    // Эта функция может быть использована для динамического расчета цены
    // Реализация зависит от конкретных требований
    return 0;
}
