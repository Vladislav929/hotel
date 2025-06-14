<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оплата бронирования</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .payment-container { max-width: 600px; margin: 40px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .payment-header { border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="payment-container">
            <div class="payment-header">
                <h2>Оплата бронирования #<?= htmlspecialchars($bookingId) ?></h2>
                <p class="text-muted">Заполните данные платежной карты</p>
            </div>
            
            <form id="paymentForm" method="POST" action="process_payment.php">
                <input type="hidden" name="booking_id" value="<?= htmlspecialchars($bookingId) ?>">
                
                <div class="mb-3">
                    <label for="cardNumber" class="form-label">Номер карты</label>
                    <input type="text" class="form-control" id="cardNumber" name="card_number" placeholder="0000 0000 0000 0000" required>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="expiryDate" class="form-label">Срок действия</label>
                        <input type="text" class="form-control" id="expiryDate" name="expiry_date" placeholder="MM/YY" required>
                    </div>
                    <div class="col-md-6">
                        <label for="cvv" class="form-label">CVV-код</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="cardName" class="form-label">Имя владельца карты</label>
                    <input type="text" class="form-control" id="cardName" name="card_name" placeholder="IVAN IVANOV" required>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success btn-lg">Подтвердить оплату</button>
                    <a href="index.php?action=bookings" class="btn btn-secondary">Вернуться к списку</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Простая валидация формы
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        const cardNumber = document.getElementById('cardNumber').value.replace(/\s/g, '');
        if (!/^\d{16}$/.test(cardNumber)) {
            alert('Некорректный номер карты');
            e.preventDefault();
        }
    });
    </script>
</body>
</html>
